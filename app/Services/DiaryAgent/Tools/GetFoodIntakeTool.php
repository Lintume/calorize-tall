<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\FoodIntake;
use Prism\Prism\Tool;

class GetFoodIntakeTool extends Tool
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
            ->as('getFoodIntake')
            ->for('Get products from a specific meal on a specific date. Useful for: 1) Finding items to delete/edit, 2) Copying meals between days. Returns list of food intake entries with their IDs.')
            ->withStringParameter('date', 'Date in YYYY-MM-DD format (e.g., "2024-12-24")')
            ->withEnumParameter(
                'mealType',
                'Type of meal',
                ['breakfast', 'lunch', 'dinner', 'snack', 'сніданок', 'обід', 'вечеря', 'перекус']
            )
            ->using($this);
    }

    public function __invoke(string $date, string $mealType): string
    {
        $userId = auth()->id();

        if (! $userId) {
            return json_encode([
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        $mealTypeValue = self::MEAL_TYPES[strtolower($mealType)] ?? null;

        if ($mealTypeValue === null) {
            return json_encode([
                'success' => false,
                'message' => "Invalid meal type: {$mealType}",
            ]);
        }

        $intakes = FoodIntake::where('user_id', $userId)
            ->where('date', $date)
            ->where('type_food_intake', $mealTypeValue)
            ->with('product')
            ->get();

        if ($intakes->isEmpty()) {
            return json_encode([
                'success' => true,
                'message' => "No items found in {$mealType} for {$date}",
                'items' => [],
            ]);
        }

        $items = $intakes->map(function ($intake) {
            return [
                'foodIntakeId' => $intake->id,
                'productId' => $intake->product_id,
                'productTitle' => $intake->product->title,
                'grams' => $intake->g,
                'calories' => $intake->calories,
                'proteins' => $intake->proteins,
                'fats' => $intake->fats,
                'carbohydrates' => $intake->carbohydrates,
            ];
        });

        return json_encode([
            'success' => true,
            'date' => $date,
            'mealType' => $mealType,
            'items' => $items->toArray(),
        ]);
    }
}

