<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\FoodIntake;
use Prism\Prism\Tool;

class UpdateFoodIntakeTool extends Tool
{
    public function __construct()
    {
        $this
            ->as('updateFoodIntake')
            ->for('Update the grams for ONE existing food intake entry. Use getFoodIntake first to get the foodIntakeId.')
            ->withNumberParameter('foodIntakeId', 'Food intake ID from getFoodIntake result')
            ->withNumberParameter('grams', 'New amount in grams')
            ->using($this);
    }

    public function __invoke(int $foodIntakeId, float $grams): string
    {
        $userId = auth()->id();

        if (! $userId) {
            return $this->toolResult('updateFoodIntake', [
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        $foodIntake = FoodIntake::where('id', $foodIntakeId)
            ->where('user_id', $userId)
            ->with('product')
            ->first();

        if (! $foodIntake) {
            return $this->toolResult('updateFoodIntake', [
                'success' => false,
                'message' => "Food intake with ID {$foodIntakeId} not found or access denied.",
            ]);
        }

        $product = $foodIntake->product;
        $oldGrams = $foodIntake->g;

        // Recalculate nutritional values based on new grams
        $multiplier = $grams / 100;

        $foodIntake->update([
            'g' => $grams,
            'proteins' => round($product->proteins * $multiplier, 1),
            'fats' => round($product->fats * $multiplier, 1),
            'carbohydrates' => round($product->carbohydrates * $multiplier, 1),
            'calories' => round($product->calories * $multiplier),
        ]);

        return $this->toolResult('updateFoodIntake', [
            'success' => true,
            'message' => "Updated {$product->title}: {$oldGrams}g → {$grams}g",
            'foodIntake' => [
                'id' => $foodIntake->id,
                'productTitle' => $product->title,
                'oldGrams' => $oldGrams,
                'newGrams' => $grams,
                'calories' => $foodIntake->calories,
            ],
        ]);
    }

    private function toolResult(string $tool, array $payload): string
    {
        return json_encode($payload);
    }
}

