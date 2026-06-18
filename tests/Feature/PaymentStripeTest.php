<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Services\StripeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Tests\TestCase;

class PaymentStripeTest extends TestCase
{
    use RefreshDatabase;

    protected User $student;

    protected Course $course;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = User::factory()->create();

        $category = Category::create([
            'name' => 'Inocuidad',
            'slug' => 'inocuidad',
            'description' => 'Inocuidad alimentaria',
            'icon' => '🛡️',
            'order' => 1,
        ]);

        $this->course = Course::create([
            'category_id' => $category->id,
            'name' => 'HACCP Avanzado',
            'slug' => 'haccp-avanzado',
            'short_description' => 'HACCP',
            'level' => 'avanzado',
            'status' => 'publicado',
            'price' => 150.00,
            'duration_weeks' => 8,
        ]);
    }

    /**
     * Un carrito vacío no debe iniciar ningún pago: redirige a cursos.
     */
    public function test_pago_with_empty_cart_redirects_to_cursos(): void
    {
        $response = $this->actingAs($this->student)->post(route('pago.procesar'));

        $response->assertRedirect(route('cursos'));
        $response->assertSessionHas('status');
        $this->assertDatabaseCount('sales', 0);
        $this->assertDatabaseCount('sale_items', 0);
    }

    /**
     * process() debe crear la venta y sus items en estado "pendiente"
     * y redirigir al cliente a la URL de Stripe Checkout.
     */
    public function test_process_creates_pending_sale_and_redirects_to_stripe(): void
    {
        $this->mock(StripeService::class, function ($mock) {
            $mock->shouldReceive('isConfigured')->andReturn(true);
            $mock->shouldReceive('createCheckoutSession')
                ->once()
                ->andReturn('https://checkout.stripe.com/c/pay/cs_test_123');
        });

        $this->actingAs($this->student)->postJson('/cart/add', ['course_id' => $this->course->id]);

        $response = $this->actingAs($this->student)->post(route('pago.procesar'));

        $response->assertRedirect('https://checkout.stripe.com/c/pay/cs_test_123');

        $this->assertDatabaseHas('sales', [
            'user_id' => $this->student->id,
            'payment_method' => 'stripe',
            'payment_status' => 'pendiente',
            'subtotal' => 150.00,
            'discount' => 0.00,
            'total' => 150.00,
        ]);

        $sale = Sale::where('user_id', $this->student->id)->first();

        $this->assertDatabaseHas('sale_items', [
            'sale_id' => $sale->id,
            'course_id' => $this->course->id,
            'price' => 150.00,
        ]);

        // El carrito se conserva: solo se limpia al confirmar el pago.
        $this->assertNotEmpty(session()->get('cart'));
    }

    /**
     * Si Stripe no está configurado, process() redirige al checkout con un
     * mensaje claro y no crea ninguna venta.
     */
    public function test_process_without_stripe_configured_redirects_with_message(): void
    {
        $this->mock(StripeService::class, function ($mock) {
            $mock->shouldReceive('isConfigured')->andReturn(false);
        });

        $this->actingAs($this->student)->postJson('/cart/add', ['course_id' => $this->course->id]);

        $response = $this->actingAs($this->student)->post(route('pago.procesar'));

        $response->assertRedirect(route('checkout'));
        $response->assertSessionHas('status');
        $this->assertDatabaseCount('sales', 0);
    }

    /**
     * confirmSale() debe ser idempotente: tanto el retorno del navegador
     * como el webhook pueden invocarlo para la misma venta sin duplicar
     * inscripciones ni contabilizar el cupón más de una vez.
     */
    public function test_confirm_sale_is_idempotent_via_success_redirect(): void
    {
        $coupon = Coupon::create([
            'code' => 'IDEMP10',
            'type' => 'porcentaje',
            'value' => 10.00,
            'start_date' => now()->subDay()->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
            'usage_limit' => 10,
            'times_used' => 0,
            'is_active' => true,
        ]);

        $sale = Sale::factory()->create([
            'user_id' => $this->student->id,
            'coupon_id' => $coupon->id,
            'subtotal' => 150.00,
            'discount' => 15.00,
            'total' => 135.00,
            'payment_method' => 'stripe',
            'payment_status' => 'pendiente',
            'stripe_payment_id' => null,
            'paid_at' => null,
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'course_id' => $this->course->id,
            'price' => 150.00,
        ]);

        $fakeSession = StripeCheckoutSession::constructFrom([
            'id' => 'cs_test_123',
            'object' => 'checkout.session',
            'payment_status' => 'paid',
            'metadata' => ['sale_id' => (string) $sale->id],
        ]);

        $this->mock(StripeService::class, function ($mock) use ($fakeSession) {
            $mock->shouldReceive('retrieveSession')
                ->with('cs_test_123')
                ->andReturn($fakeSession);
        });

        // 1ra confirmación: por ejemplo, el navegador vuelve de Stripe.
        $response = $this->actingAs($this->student)
            ->get(route('pago.confirmar', ['session_id' => 'cs_test_123']));

        $response->assertRedirect(route('pago.exito'));
        $response->assertSessionHas('paid_count', 1);

        $sale->refresh();
        $this->assertSame('pagado', $sale->payment_status);
        $this->assertNotNull($sale->paid_at);
        $this->assertSame('cs_test_123', $sale->stripe_payment_id);
        $this->assertEquals(1, $coupon->fresh()->times_used);
        $this->assertEquals(1, Enrollment::where('user_id', $this->student->id)
            ->where('course_id', $this->course->id)
            ->where('status', 'activo')
            ->count());

        // 2da confirmación: por ejemplo, el webhook llega después.
        $response = $this->actingAs($this->student)
            ->get(route('pago.confirmar', ['session_id' => 'cs_test_123']));

        $response->assertRedirect(route('pago.exito'));

        $sale->refresh();
        $this->assertSame('pagado', $sale->payment_status);
        // El cupón y la inscripción no deben duplicarse en la 2da confirmación.
        $this->assertEquals(1, $coupon->fresh()->times_used);
        $this->assertEquals(1, Enrollment::where('user_id', $this->student->id)
            ->where('course_id', $this->course->id)
            ->count());
    }
}
