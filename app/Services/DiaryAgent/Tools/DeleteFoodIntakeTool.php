<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\FoodIntake;
use Prism\Prism\Tool;

class DeleteFoodIntakeTool extends Tool
{
    public function __construct()
    {
        $this
            ->as('deleteFoodIntake')
            ->for('Delete ONE food intake entry from the diary. Use getFoodIntake first to find the foodIntakeId of the item to delete.')
            ->withNumberParameter('foodIntakeId', 'Food intake ID from getFoodIntake result')
            ->using($this);
    }

    public function __invoke(int $foodIntakeId): string
    {
        $userId = auth()->id();

        if (! $userId) {
            return json_encode([
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        $foodIntake = FoodIntake::where('id', $foodIntakeId)
            ->where('user_id', $userId)
            ->with('product')
            ->first();

        if (! $foodIntake) {
            return json_encode([
                'success' => false,
                'message' => "Food intake with ID {$foodIntakeId} not found or access denied.",
            ]);
        }

        $productTitle = $foodIntake->product->title;
        $grams = $foodIntake->g;

        $foodIntake->delete();

        return json_encode([
            'success' => true,
            'message' => "Deleted {$grams}g of {$productTitle} from diary",
            'deleted' => [
                'id' => $foodIntakeId,
                'productTitle' => $productTitle,
                'grams' => $grams,
            ],
        ]);
    }
}

