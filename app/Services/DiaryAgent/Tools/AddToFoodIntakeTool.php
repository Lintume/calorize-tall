<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\FoodIntake;
use App\Models\Product;
use Prism\Prism\Tool;

class AddToFoodIntakeTool extends Tool
{
    /**
     * Meal type mapping: name to database value
     */
    private const MEAL_TYPES = [
        'breakfast' => 1,
        'сніданок' => 1,
        'lunch' => 2,
        'обід' => 2,
        'dinner' => 3,
        'вечеря' => 3,
        'snack' => 4,
        'перекус' => 4,
    ];

    public function __construct()
    {
        $this
            ->as('addToFoodIntake')
            ->for('Add ONE product to a meal. Call this tool multiple times for multiple products. Use default grams if user did not specify amount.')
            ->withNumberParameter('productId', 'Product ID from searchProduct result')
            ->withNumberParameter('grams', 'Amount in grams (use sensible defaults: apple=150, egg=60, tea=250, bread slice=30, candy=10)')
            ->withEnumParameter(
                'mealType',
                'Type of meal',
                ['breakfast', 'lunch', 'dinner', 'snack', 'сніданок', 'обід', 'вечеря', 'перекус']
            )
            ->withStringParameter('date', 'Date in YYYY-MM-DD format')
            ->using($this);
    }

    public function __invoke(int $productId, float $grams, string $mealType, string $date): string
    {
        $userId = auth()->id();

        if (! $userId) {
            return json_encode([
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        $product = Product::find($productId);

        if (! $product) {
            return json_encode([
                'success' => false,
                'message' => "Product with ID {$productId} not found.",
            ]);
        }

        $mealTypeValue = self::MEAL_TYPES[strtolower($mealType)] ?? null;

        if ($mealTypeValue === null) {
            return json_encode([
                'success' => false,
                'message' => "Invalid meal type: {$mealType}",
            ]);
        }

        // Calculate nutritional values based on grams
        $multiplier = $grams / 100;

        $foodIntake = FoodIntake::create([
            'product_id' => $productId,
            'user_id' => $userId,
            'g' => $grams,
            'proteins' => round($product->proteins * $multiplier, 1),
            'fats' => round($product->fats * $multiplier, 1),
            'carbohydrates' => round($product->carbohydrates * $multiplier, 1),
            'calories' => round($product->calories * $multiplier),
            'type_food_intake' => $mealTypeValue,
            'date' => $date,
        ]);

        return json_encode([
            'success' => true,
            'message' => "Added {$grams}g of {$product->title} to {$mealType}",
            'foodIntake' => [
                'id' => $foodIntake->id,
                'productTitle' => $product->title,
                'grams' => $grams,
                'calories' => $foodIntake->calories,
            ],
        ]);
    }
}

