<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Enrollment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\StripeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Controlador del flujo de pago con Stripe Checkout.
 *
 * El servidor nunca recibe ni almacena datos de tarjeta: el cliente paga en
 * la página alojada por Stripe y regresa a través de success_url/cancel_url,
 * mientras que el webhook confirma la venta de forma asíncrona y confiable.
 */
class PaymentController extends Controller
{
    public function __construct(protected StripeService $stripeService)
    {
    }

    /**
     * Inicia el pago: crea la venta en estado "pendiente" junto con sus
     * items y redirige al cliente a la sesión de Stripe Checkout.
     */
    public function process(Request $request): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cursos')
                ->with('status', 'Tu carrito estaba vacío.');
        }

        if (! $this->stripeService->isConfigured()) {
            return redirect()->route('checkout')
                ->with('status', 'La pasarela de pago no está disponible en este momento. Por favor, inténtalo más tarde o contacta con soporte.');
        }

        $subtotal = (float) collect($cart)->sum(fn ($item) => (float) $item['price']);
        $discount = 0.0;
        $couponId = null;

        // El cupón se lee de la sesión, pero su contador de usos solo se
        // incrementa cuando el pago queda confirmado (ver confirmSale()).
        if (session()->has('coupon_code')) {
            $coupon = Coupon::where('code', session('coupon_code'))->first();

            if ($coupon && $coupon->is_valid) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponId = $coupon->id;
            }
        }

        $total = max(0.00, $subtotal - $discount);

        $sale = Sale::create([
            'user_id' => auth()->id(),
            'coupon_id' => $couponId,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => 'stripe',
            'payment_status' => 'pendiente',
            'notes' => 'Pago iniciado vía Stripe Checkout.',
        ]);

        foreach ($cart as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'course_id' => $item['course_id'],
                'price' => $item['price'],
            ]);
        }

        $successUrl = route('pago.confirmar').'?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = route('pago.cancelado', $sale);

        try {
            $checkoutUrl = $this->stripeService->createCheckoutSession($sale, $cart, $successUrl, $cancelUrl);
        } catch (\Throwable $e) {
            $sale->update([
                'payment_status' => 'fallido',
                'notes' => 'No se pudo crear la sesión de pago de Stripe: '.$e->getMessage(),
            ]);

            Log::error('Error al crear la sesión de Stripe Checkout.', [
                'sale_id' => $sale->id,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('checkout')
                ->with('status', 'No se pudo iniciar el pago con Stripe. Por favor, inténtalo nuevamente.');
        }

        return redirect()->away($checkoutUrl);
    }

    /**
     * El cliente regresa desde Stripe Checkout tras completar el pago.
     * Verifica la sesión con la API de Stripe y, si el pago fue exitoso,
     * confirma la venta correspondiente.
     */
    public function success(Request $request): RedirectResponse
    {
        $sessionId = (string) $request->query('session_id', '');

        if ($sessionId === '') {
            return redirect()->route('checkout')
                ->with('status', 'No se recibió información del pago. Si realizaste el cargo, contáctanos para verificarlo.');
        }

        try {
            $session = $this->stripeService->retrieveSession($sessionId);
        } catch (\Throwable $e) {
            Log::error('Error al recuperar la sesión de Stripe Checkout.', [
                'session_id' => $sessionId,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('checkout')
                ->with('status', 'No pudimos verificar tu pago. Si realizaste el cargo, contáctanos para confirmarlo.');
        }

        if ($session->payment_status !== 'paid') {
            return redirect()->route('checkout')
                ->with('status', 'Tu pago no se completó. Puedes intentarlo nuevamente cuando quieras.');
        }

        $saleId = $session->metadata?->sale_id;
        $sale = $saleId ? Sale::find($saleId) : null;

        if (! $sale || $sale->user_id !== auth()->id()) {
            Log::error('Webhook/retorno de Stripe: venta no encontrada o no pertenece al usuario.', [
                'sale_id' => $saleId,
                'session_id' => $sessionId,
            ]);

            return redirect()->route('checkout')
                ->with('status', 'No encontramos la venta asociada a este pago. Contáctanos para verificarlo.');
        }

        $this->confirmSale($sale, $session->id);

        return redirect()->route('pago.exito')
            ->with('paid_count', $sale->items()->count());
    }

    /**
     * El cliente cancela el pago desde Stripe Checkout. La venta pendiente
     * se marca como fallida y el carrito se conserva para reintentar.
     */
    public function cancel(Sale $sale): RedirectResponse
    {
        if ($sale->user_id !== auth()->id()) {
            abort(403);
        }

        if ($sale->payment_status === 'pendiente') {
            $sale->update([
                'payment_status' => 'fallido',
                'notes' => 'Pago cancelado por el cliente desde Stripe Checkout.',
            ]);
        }

        return redirect()->route('checkout')
            ->with('status', 'Pago cancelado. Tu carrito sigue disponible para intentarlo nuevamente.');
    }

    /**
     * Webhook de Stripe: confirma la venta de forma asíncrona cuando Stripe
     * notifica que la sesión de Checkout se completó con pago exitoso.
     */
    public function webhook(Request $request): Response
    {
        try {
            $event = $this->stripeService->handleWebhook(
                $request->getContent(),
                (string) $request->header('Stripe-Signature', '')
            );
        } catch (\Throwable $e) {
            Log::error('Firma de webhook de Stripe inválida.', ['message' => $e->getMessage()]);

            return response('Invalid signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            if (($session->payment_status ?? null) === 'paid') {
                $saleId = $session->metadata?->sale_id;
                $sale = $saleId ? Sale::find($saleId) : null;

                if ($sale) {
                    $this->confirmSale($sale, $session->id);
                } else {
                    Log::error('Webhook de Stripe: venta no encontrada.', [
                        'sale_id' => $saleId,
                        'session_id' => $session->id,
                    ]);
                }
            }
        }

        return response()->json(['received' => true]);
    }

    /**
     * Confirma una venta como pagada de forma idempotente: marca la venta,
     * contabiliza el cupón, crea/reactiva las inscripciones y limpia el
     * carrito. Puede ser invocado tanto por el webhook como por el retorno
     * del navegador, por lo que si la venta ya está pagada no hace nada más.
     */
    protected function confirmSale(Sale $sale, string $stripeSessionId): void
    {
        if ($sale->payment_status === 'pagado') {
            return;
        }

        DB::transaction(function () use ($sale, $stripeSessionId) {
            $sale->update([
                'payment_status' => 'pagado',
                'paid_at' => now(),
                'stripe_payment_id' => $stripeSessionId,
                'notes' => trim(($sale->notes ? $sale->notes.' ' : '')."Confirmado por Stripe (session: {$stripeSessionId})."),
            ]);

            if ($sale->coupon_id) {
                $sale->coupon?->increment('times_used');
            }

            foreach ($sale->items as $item) {
                $enrollment = Enrollment::where('user_id', $sale->user_id)
                    ->where('course_id', $item->course_id)
                    ->first();

                if (! $enrollment) {
                    Enrollment::create([
                        'user_id' => $sale->user_id,
                        'course_id' => $item->course_id,
                        'status' => Enrollment::STATUS_ACTIVE,
                        'enrolled_at' => now(),
                    ]);
                } elseif (in_array($enrollment->status, [Enrollment::STATUS_PENDING, Enrollment::STATUS_SUSPENDED], true)) {
                    $enrollment->update([
                        'status' => Enrollment::STATUS_ACTIVE,
                        'enrolled_at' => now(),
                    ]);
                }
            }
        });

        Cache::forget('admin_dashboard_stats');

        session()->forget(['cart', 'coupon_code']);
    }
}
