<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicCourseCatalogTest extends TestCase
{
    use RefreshDatabase;

    private Category $categoryA;
    private Category $categoryB;
    private Course $publishedCourse;
    private Course $draftCourse;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categoryA = Category::create([
            'name' => 'Calidad Alimentaria',
            'slug' => 'calidad-alimentaria'
        ]);

        $this->categoryB = Category::create([
            'name' => 'Sistemas ISO',
            'slug' => 'sistemas-iso'
        ]);

        $this->publishedCourse = Course::create([
            'category_id' => $this->categoryA->id,
            'name' => 'Buenas Prácticas de Manufactura BPM',
            'slug' => 'bpm-alimentos',
            'short_description' => 'Aprende BPM de forma práctica.',
            'description' => 'Descripción detallada de BPM.',
            'cover_image' => 'bpm.png',
            'level' => 'basico',
            'status' => 'publicado',
            'price' => 200.00
        ]);

        $this->draftCourse = Course::create([
            'category_id' => $this->categoryB->id,
            'name' => 'ISO 22000 Inocuidad',
            'slug' => 'iso-22000-inocuidad',
            'short_description' => 'Curso en borrador.',
            'description' => 'Descripción detallada de ISO.',
            'cover_image' => 'iso.png',
            'level' => 'avanzado',
            'status' => 'borrador',
            'price' => 400.00
        ]);
    }

    public function test_catalog_lists_only_published_courses()
    {
        $response = $this->get('/cursos');

        $response->assertStatus(200);
        $response->assertSee('Buenas Prácticas de Manufactura BPM');
        $response->assertDontSee('ISO 22000 Inocuidad');
    }

    public function test_catalog_filters_by_level()
    {
        $response = $this->get('/cursos?level=basico');
        $response->assertStatus(200);
        $response->assertSee('Buenas Prácticas de Manufactura BPM');

        $response = $this->get('/cursos?level=avanzado');
        $response->assertStatus(200);
        $response->assertDontSee('Buenas Prácticas de Manufactura BPM');
    }

    public function test_catalog_filters_by_category()
    {
        $response = $this->get('/cursos?category_id=' . $this->categoryA->id);
        $response->assertStatus(200);
        $response->assertSee('Buenas Prácticas de Manufactura BPM');

        $response = $this->get('/cursos?category_id=' . $this->categoryB->id);
        $response->assertStatus(200);
        $response->assertDontSee('Buenas Prácticas de Manufactura BPM');
    }

    public function test_catalog_filters_by_search_query()
    {
        $response = $this->get('/cursos?search=Manufactura');
        $response->assertStatus(200);
        $response->assertSee('Buenas Prácticas de Manufactura BPM');

        $response = $this->get('/cursos?search=ISO');
        $response->assertStatus(200);
        $response->assertDontSee('Buenas Prácticas de Manufactura BPM');
    }

    public function test_public_user_can_view_published_course_detail()
    {
        $response = $this->get('/cursos/bpm-alimentos');

        $response->assertStatus(200);
        $response->assertSee('Buenas Prácticas de Manufactura BPM');
        $response->assertSee('Descripción detallada de BPM');
    }

    public function test_public_user_cannot_view_draft_course_detail()
    {
        $response = $this->get('/cursos/iso-22000-inocuidad');

        $response->assertStatus(404);
    }

    public function test_admin_user_can_view_draft_course_detail()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/cursos/iso-22000-inocuidad');

        $response->assertStatus(200);
        $response->assertSee('ISO 22000 Inocuidad');
    }

    public function test_cart_operations_using_course_id()
    {
        $user = User::factory()->create();

        // Guest can add to cart since it's not protected by auth
        $response = $this->postJson('/cart/add', ['course_id' => $this->publishedCourse->id]);
        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        // Reset cart for subsequent authenticated user tests
        session()->forget('cart');

        $this->actingAs($user);

        // Add valid course
        $response = $this->postJson('/cart/add', ['course_id' => $this->publishedCourse->id]);
        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        // Adding duplicate course should be rejected
        $response = $this->postJson('/cart/add', ['course_id' => $this->publishedCourse->id]);
        $response->assertStatus(422);

        // Check checkout page renders
        $response = $this->get('/checkout');
        $response->assertStatus(200);
        $response->assertSee('Buenas Prácticas de Manufactura BPM');

        // Remove course
        $response = $this->postJson('/cart/remove', ['course_id' => $this->publishedCourse->id]);
        $response->assertStatus(200);
        $response->assertJson(['ok' => true, 'count' => 0]);
    }
}
