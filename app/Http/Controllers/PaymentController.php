<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'card_name'   => ['required', 'string'],
            'card_number' => ['required', 'string', 'min:16'],
            'card_exp'    => ['required', 'string'],
            'card_cvc'    => ['required', 'string', 'min:3'],
        ], [
            'card_name.required'   => 'Ingresa el nombre en la tarjeta.',
            'card_number.required' => 'Ingresa el número de tarjeta.',
            'card_number.min'      => 'El número debe tener al menos 16 dígitos.',
            'card_exp.required'    => 'Ingresa la fecha de expiración.',
            'card_cvc.required'    => 'Ingresa el código CVC.',
            'card_cvc.min'         => 'El CVC debe tener al menos 3 dígitos.',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cursos')
                ->with('status', 'Tu carrito estaba vacío.');
        }

        $subtotal = collect($cart)->sum('price');
        $discount = 0;
        $couponId = null;

        // Apply coupon if code is stored in session and valid
        if (session()->has('coupon_code')) {
            $couponCode = session()->get('coupon_code');
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon && $coupon->is_valid) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponId = $coupon->id;
                $coupon->increment('times_used');
            }
        }

        $total = max(0.00, $subtotal - $discount);

        // 1. Create Sale record
        $sale = Sale::create([
            'user_id' => auth()->id(),
            'coupon_id' => $couponId,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => 'tarjeta',
            'payment_status' => 'pagado',
            'notes' => 'Compra realizada en checkout simulado.',
            'paid_at' => now(),
        ]);

        // 2. Create Sale items and Enrollments
        foreach ($cart as $item) {
            // Create Sale Item
            SaleItem::create([
                'sale_id' => $sale->id,
                'course_id' => $item['course_id'],
                'price' => $item['price'],
            ]);

            // Avoid duplicate enrollments
            $enrollment = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $item['course_id'])
                ->first();

            if (!$enrollment) {
                Enrollment::create([
                    'user_id'     => auth()->id(),
                    'course_id'   => $item['course_id'],
                    'status'      => 'activo',
                    'enrolled_at' => now(),
                ]);
            } else {
                // Reactivate enrollment if it was pending or suspended
                if (in_array($enrollment->status, ['pendiente', 'suspendido'])) {
                    $enrollment->update([
                        'status' => 'activo',
                        'enrolled_at' => now(),
                    ]);
                }
            }
        }

        session()->forget('cart');
        session()->forget('coupon_code');

        // Invalidate admin dashboard cache
        \Illuminate\Support\Facades\Cache::forget('admin_dashboard_stats');

        return redirect()->route('pago.exito')
            ->with('paid_count', count($cart));
    }
}
