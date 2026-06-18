<?php

namespace App\Services;

use App\Models\Sale;
use Stripe\Checkout\Session;
use Stripe\Event;
use Stripe\StripeClient;
use Stripe\Webhook;

/**
 * Servicio de integración con Stripe Checkout.
 *
 * Toda la captura de datos de tarjeta ocurre en la página de pago alojada
 * por Stripe (Stripe Checkout); este servicio solo crea/recupera sesiones
 * y valida los webhooks. El servidor nunca recibe ni almacena datos de
 * tarjeta.
 */
class StripeService
{
    protected string $secretKey;

    protected string $webhookSecret;

    protected string $currency;

    protected ?StripeClient $client;

    public function __construct()
    {
        $this->secretKey = (string) config('stripe.secret', '');
        $this->webhookSecret = (string) config('stripe.webhook_secret', '');
        $this->currency = (string) config('stripe.currency', 'pen');
        $this->client = $this->secretKey !== '' ? new StripeClient($this->secretKey) : null;
    }

    /**
     * Indica si las credenciales de Stripe están configuradas.
     */
    public function isConfigured(): bool
    {
        return $this->secretKey !== '';
    }

    /**
     * Crea una sesión de Stripe Checkout para la venta indicada y devuelve
     * la URL a la que debe redirigirse al cliente para pagar.
     *
     * @param  Sale  $sale  Venta pendiente asociada a la sesión (debe tener id, total, discount y user)
     * @param  array<int, array{course_id:int|string, course_name:string, level?:string, price:float|int|string}>  $cartItems  Items del carrito
     * @param  string  $successUrl  URL de retorno al confirmar el pago, debe contener el literal {CHECKOUT_SESSION_ID}
     * @param  string  $cancelUrl  URL de retorno si el cliente cancela el pago
     * @return string URL de la sesión de Stripe Checkout (Session::$url)
     *
     * @throws \Stripe\Exception\ApiErrorException si Stripe rechaza la solicitud
     */
    public function createCheckoutSession(Sale $sale, array $cartItems, string $successUrl, string $cancelUrl): string
    {
        $client = $this->client();

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => $this->currency,
                    'product_data' => [
                        'name' => (string) $item['course_name'],
                    ],
                    'unit_amount' => (int) round(((float) $item['price']) * 100),
                ],
                'quantity' => 1,
            ];
        }

        $params = [
            'mode' => 'payment',
            'line_items' => $lineItems,
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'metadata' => [
                'sale_id' => (string) $sale->id,
            ],
        ];

        if ($sale->user && $sale->user->email) {
            $params['customer_email'] = $sale->user->email;
        }

        // Si la venta tiene descuento, se crea un cupón de Stripe de un solo
        // uso (amount_off) para reflejar el mismo descuento en Checkout.
        if ((float) $sale->discount > 0) {
            $coupon = $client->coupons->create([
                'amount_off' => (int) round(((float) $sale->discount) * 100),
                'currency' => $this->currency,
                'duration' => 'once',
                'name' => 'Descuento aplicado',
            ]);

            $params['discounts'] = [
                ['coupon' => $coupon->id],
            ];
        }

        $session = $client->checkout->sessions->create($params);

        return (string) $session->url;
    }

    /**
     * Recupera una sesión de Stripe Checkout por su identificador.
     *
     * @throws \Stripe\Exception\ApiErrorException si Stripe rechaza la solicitud
     */
    public function retrieveSession(string $sessionId): Session
    {
        return $this->client()->checkout->sessions->retrieve($sessionId);
    }

    /**
     * Valida la firma de un webhook de Stripe y devuelve el evento.
     *
     * @throws \UnexpectedValueException si el payload no es JSON válido
     * @throws \Stripe\Exception\SignatureVerificationException si la firma no es válida
     */
    public function handleWebhook(string $payload, string $signature): Event
    {
        return Webhook::constructEvent($payload, $signature, $this->webhookSecret);
    }

    /**
     * Devuelve el cliente de Stripe ya inicializado.
     *
     * @throws \RuntimeException si Stripe no está configurado (debe validarse con isConfigured() antes)
     */
    protected function client(): StripeClient
    {
        if (! $this->client) {
            throw new \RuntimeException('Stripe no está configurado: falta STRIPE_SECRET.');
        }

        return $this->client;
    }
}
