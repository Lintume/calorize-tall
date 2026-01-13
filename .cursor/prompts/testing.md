# Testing in Calorize

## Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter=ProductTest

# Run with coverage
php artisan test --coverage

# Using PHPUnit directly
./vendor/bin/phpunit
./vendor/bin/phpunit --filter=test_method_name
```

## Feature Test Template

```php
<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_page(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/diary');

        $response->assertOk();
    }

    public function test_guest_cannot_access_protected_route(): void
    {
        // Note: /diary redirects guests to '/' (home), other protected routes redirect to '/login'
        $response = $this->get('/statistic');

        $response->assertRedirect('/login');
    }

    public function test_user_can_create_product(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/product', [
                'title' => 'Test Product',
                'proteins' => 10.5,
                'fats' => 5.2,
                'carbohydrates' => 20.0,
                'calories' => 150,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'title' => 'Test Product',
            'user_id' => $user->id,
        ]);
    }
}
```

## Livewire Component Test

```php
<?php

namespace Tests\Feature;

use App\Livewire\ProductSearch;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_search_products(): void
    {
        Product::factory()->create(['title' => 'Apple']);
        Product::factory()->create(['title' => 'Banana']);

        Livewire::test(ProductSearch::class)
            ->set('search', 'Apple')
            ->assertSee('Apple')
            ->assertDontSee('Banana');
    }

    public function test_shows_user_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->create([
            'title' => 'User Recipe',
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(ProductSearch::class)
            ->assertSee('User Recipe');
    }
}
```

## Test Database Setup

Tests use `RefreshDatabase` trait which:
- Wraps each test in a transaction
- Rolls back after each test
- Creates fresh schema when needed

## Factories

Located in `database/factories/`:

```php
// UserFactory.php creates users with:
// - name, email, password, email_verified_at

// Add ProductFactory if needed:
php artisan make:factory ProductFactory
```

## Common Assertions

```php
// Response assertions
$response->assertOk();           // 200
$response->assertRedirect();     // 30x
$response->assertForbidden();    // 403
$response->assertNotFound();     // 404

// Database assertions
$this->assertDatabaseHas('products', ['title' => 'Test']);
$this->assertDatabaseMissing('products', ['title' => 'Test']);
$this->assertDatabaseCount('products', 5);

// Livewire assertions
->assertSee('Text')
->assertDontSee('Text')
->assertSet('property', 'value')
->assertEmitted('event-name')
```

## Tips

1. Use `RefreshDatabase` for tests that modify data
2. Create factories for models you test frequently
3. Test both happy path and edge cases
4. Test authorization (user can only edit own products)
5. Test validation errors

