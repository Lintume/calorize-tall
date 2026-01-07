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
            ->for('Delete ONE entry. Use getFoodIntake first.')
            ->withNumberParameter('foodIntakeId', 'Food intake ID from getFoodIntake')
            ->using($this);
    }

    public function __invoke(int $foodIntakeId): string
    {
        $userId = auth()->id();

        if (! $userId) {
            return $this->toolResult('deleteFoodIntake', [
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        $foodIntake = FoodIntake::where('id', $foodIntakeId)
            ->where('user_id', $userId)
            ->with('product')
            ->first();

        if (! $foodIntake) {
            return $this->toolResult('deleteFoodIntake', [
                'success' => false,
                'message' => "Food intake with ID {$foodIntakeId} not found or access denied.",
            ]);
        }

        $productTitle = $foodIntake->product->title;
        $grams = $foodIntake->g;

        $foodIntake->delete();

        return $this->toolResult('deleteFoodIntake', [
            'success' => true,
            'message' => "Deleted {$grams}g of {$productTitle} from diary",
            'deleted' => [
                'id' => $foodIntakeId,
                'productTitle' => $productTitle,
                'grams' => $grams,
            ],
        ]);
    }

    private function toolResult(string $tool, array $payload): string
    {
        return json_encode($payload);
    }
}

