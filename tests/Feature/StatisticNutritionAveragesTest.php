<?php

namespace Tests\Feature;

use App\Livewire\Statistic;
use App\Models\FoodIntake;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StatisticNutritionAveragesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_calculates_average_nutrition_per_day_over_selected_period(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'title' => 'Test product',
            'user_id' => $user->id,
            'base' => false,
            'calories' => 100,
            'proteins' => 10,
            'fats' => 5,
            'carbohydrates' => 20,
        ]);

        // Period: 7 days (inclusive)
        $startDate = '2025-01-01';
        $endDate = '2025-01-07';

        // Only 2 days have entries; missing days count as 0 in the average divisor.
        FoodIntake::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'g' => 100,
            'proteins' => 30,
            'fats' => 20,
            'carbohydrates' => 10,
            'calories' => 500,
            'type_food_intake' => 1,
            'date' => '2025-01-01',
        ]);

        FoodIntake::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'g' => 100,
            'proteins' => 20,
            'fats' => 10,
            'carbohydrates' => 30,
            'calories' => 200,
            'type_food_intake' => 2,
            'date' => '2025-01-03',
        ]);

        // Totals in range: kcal 700, P 50, F 30, C 40; days=7
        Livewire::actingAs($user)
            ->test(Statistic::class)
            ->set('startDate', $startDate)
            ->set('endDate', $endDate)
            ->assertSet('nutrition.days', 7)
            ->assertSet('nutrition.avg.calories', 100) // round(700/7)
            ->assertSet('nutrition.avg.proteins', 7) // round(50/7)
            ->assertSet('nutrition.avg.fats', 4) // round(30/7)
            ->assertSet('nutrition.avg.carbohydrates', 6); // round(40/7)
    }
}


