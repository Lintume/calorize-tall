<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Smoke tests for all main pages.
 *
 * These tests ensure that pages render without fatal errors (500s).
 * They catch issues like:
 * - Blade template syntax errors
 * - Missing views
 * - Unhandled exceptions in controllers
 * - Broken Livewire components
 *
 * Run with: ./vendor/bin/sail test --filter=SmokeTest
 */
class SmokeTest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | Public Pages (No Authentication Required)
    |--------------------------------------------------------------------------
    */

    public function test_landing_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_about_page_loads(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_privacy_page_loads(): void
    {
        $response = $this->get('/privacy');

        $response->assertStatus(200);
    }

    public function test_products_index_page_loads(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_product_show_page_loads(): void
    {
        // Create a test product
        $product = Product::create([
            'title' => 'Test Product for Smoke Test',
            'proteins' => 10.5,
            'fats' => 5.2,
            'carbohydrates' => 20.3,
            'calories' => 150,
            'base' => true,
        ]);

        $response = $this->get("/product/{$product->slug}");

        $response->assertStatus(200);
    }

    public function test_product_show_page_loads_with_cyrillic_title(): void
    {
        // Test with Ukrainian product name (like the one that was broken)
        $product = Product::create([
            'title' => 'Тестовий продукт для смоук тесту',
            'proteins' => 5.3,
            'fats' => 15.6,
            'carbohydrates' => 64.9,
            'calories' => 434,
            'base' => true,
        ]);

        $response = $this->get("/product/{$product->slug}");

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | Blog Pages
    |--------------------------------------------------------------------------
    */

    public function test_blog_index_page_loads(): void
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
    }

    public function test_blog_post_1_loads(): void
    {
        $response = $this->get('/blog/yak-pravylno-rakhuvaty-kaloriyi-dlya-skhudnennya-praktychnyy-gid');

        $response->assertStatus(200);
    }

    public function test_blog_post_2_loads(): void
    {
        $response = $this->get('/blog/5-porad-dlya-efektyvnoho-skhudnennya');

        $response->assertStatus(200);
    }

    public function test_blog_post_3_loads(): void
    {
        $response = $this->get('/blog/top-10-produktiv-dlya-zdorovoho-kharchuvannya');

        $response->assertStatus(200);
    }

    public function test_blog_post_4_loads(): void
    {
        $response = $this->get('/blog/chomu-voda-vazhlyva-dlya-skhudnennya');

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | Authenticated Pages
    |--------------------------------------------------------------------------
    */

    public function test_diary_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/diary');

        $response->assertStatus(200);
    }

    public function test_statistic_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/statistic');

        $response->assertStatus(200);
    }

    public function test_profile_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
    }

    public function test_personal_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/personal');

        $response->assertStatus(200);
    }

    public function test_recipes_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/recipes');

        $response->assertStatus(200);
    }

    public function test_feedback_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/feedback');

        $response->assertStatus(200);
    }

    public function test_create_product_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/create-product');

        $response->assertStatus(200);
    }

    public function test_create_recipe_page_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/create-recipe');

        $response->assertStatus(200);
    }

    public function test_edit_product_page_loads_for_owner(): void
    {
        // User needs to be verified to edit products
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        // base=true means it's a product (not a recipe)
        $product = Product::create([
            'title' => 'User Product',
            'proteins' => 10,
            'fats' => 5,
            'carbohydrates' => 20,
            'calories' => 150,
            'base' => true,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get("/edit-product/{$product->id}");

        $response->assertStatus(200);
    }

    public function test_edit_recipe_page_loads_for_owner(): void
    {
        $user = User::factory()->create();

        $product = Product::create([
            'title' => 'User Recipe',
            'proteins' => 10,
            'fats' => 5,
            'carbohydrates' => 20,
            'calories' => 150,
            'base' => false,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get("/edit-recipe/{$product->id}");

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | Authentication Redirects (Guest users should be redirected to login)
    |--------------------------------------------------------------------------
    */

    public function test_diary_redirects_guest_to_home(): void
    {
        $response = $this->get('/diary');

        $response->assertRedirect('/');
    }

    public function test_statistic_redirects_guest_to_login(): void
    {
        $response = $this->get('/statistic');

        $response->assertRedirect('/login');
    }

    public function test_personal_redirects_guest_to_login(): void
    {
        $response = $this->get('/personal');

        $response->assertRedirect('/login');
    }

    public function test_feedback_redirects_guest_to_login(): void
    {
        $response = $this->get('/feedback');

        $response->assertRedirect('/login');
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Pages
    |--------------------------------------------------------------------------
    */

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register_page_loads(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_forgot_password_page_loads(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }
}

