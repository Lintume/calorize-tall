<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\FoodIntake;
use Illuminate\Support\Facades\Auth;
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
        // Special value: return whole day
        'all' => 0,
    ];

    private const MEAL_TYPE_LABELS_UK = [
        1 => 'сніданок',
        2 => 'обід',
        3 => 'вечеря',
        4 => 'перекус',
    ];

    public function __construct()
    {
        $this
            ->as('getFoodIntake')
            ->for('Get meal items for a date. Use for delete/edit/copy. Omit mealType or use "all" for whole day.')
            ->withStringParameter('date', 'Date (YYYY-MM-DD)')
            ->withStringParameter('mealType', 'Meal: breakfast/lunch/dinner/snack (or UA). Use "all" or omit for whole day.')
            ->using($this);
    }

    public function __invoke(string $date, ?string $mealType = null): string
    {
        $userId = Auth::id();

        if (! $userId) {
            return $this->toolResult('getFoodIntake', [
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        $mealTypeNorm = $mealType !== null ? trim(mb_strtolower($mealType)) : null;
        if ($mealTypeNorm === '') {
            $mealTypeNorm = null;
        }

        // Whole day mode: mealType omitted or "all"
        if ($mealTypeNorm === null || $mealTypeNorm === 'all') {
            $intakes = FoodIntake::where('user_id', $userId)
                ->where('date', $date)
                ->with('product')
                ->orderBy('type_food_intake')
                ->orderBy('id')
                ->get();

            if ($intakes->isEmpty()) {
                return $this->toolResult('getFoodIntake', [
                    'success' => true,
                    'message' => "No items found for {$date}",
                    'date' => $date,
                    'items' => [],
                ]);
            }

            $items = $intakes->map(function ($intake) {
                $mealValue = (int) $intake->type_food_intake;
                $mealUk = self::MEAL_TYPE_LABELS_UK[$mealValue] ?? 'обід';

                return [
                    'foodIntakeId' => $intake->id,
                    'productId' => $intake->product_id,
                    'productTitle' => $intake->product?->title,
                    'grams' => $intake->g,
                    'calories' => $intake->calories,
                    'proteins' => $intake->proteins,
                    'fats' => $intake->fats,
                    'carbohydrates' => $intake->carbohydrates,
                    'mealTypeValue' => $mealValue,
                    'mealType' => $mealUk,
                ];
            })->toArray();

            // Group for convenience (optional for the LLM)
            $meals = [];
            foreach ($items as $it) {
                $k = (string) ($it['mealType'] ?? 'обід');
                if (! isset($meals[$k])) {
                    $meals[$k] = [];
                }
                $meals[$k][] = $it;
            }

            return $this->toolResult('getFoodIntake', [
                'success' => true,
                'date' => $date,
                'mealType' => 'all',
                'items' => $items,
                'meals' => $meals,
            ]);
        }

        $mealTypeValue = self::MEAL_TYPES[$mealTypeNorm] ?? null;

        if ($mealTypeValue === null) {
            return $this->toolResult('getFoodIntake', [
                'success' => false,
                'message' => 'Invalid meal type: ' . ($mealType ?? ''),
            ]);
        }

        $intakes = FoodIntake::where('user_id', $userId)
            ->where('date', $date)
            ->where('type_food_intake', $mealTypeValue)
            ->with('product')
            ->get();

        if ($intakes->isEmpty()) {
            return $this->toolResult('getFoodIntake', [
                'success' => true,
                'message' => "No items found in {$mealTypeNorm} for {$date}",
                'items' => [],
            ]);
        }

        $items = $intakes->map(function ($intake) use ($mealTypeNorm) {
            return [
                'foodIntakeId' => $intake->id,
                'productId' => $intake->product_id,
                'productTitle' => $intake->product->title,
                'grams' => $intake->g,
                'calories' => $intake->calories,
                'proteins' => $intake->proteins,
                'fats' => $intake->fats,
                'carbohydrates' => $intake->carbohydrates,
                'mealTypeValue' => (int) $intake->type_food_intake,
                'mealType' => self::MEAL_TYPE_LABELS_UK[(int) $intake->type_food_intake] ?? (string) $mealTypeNorm,
            ];
        });

        return $this->toolResult('getFoodIntake', [
            'success' => true,
            'date' => $date,
            'mealType' => $mealTypeNorm,
            'items' => $items->toArray(),
        ]);
    }

    private function toolResult(string $tool, array $payload): string
    {
        return json_encode($payload);
    }
}

