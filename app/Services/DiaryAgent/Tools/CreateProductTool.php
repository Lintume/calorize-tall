<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\Product;
use Prism\Prism\Tool;

class CreateProductTool extends Tool
{
    public function __construct()
    {
        $this
            ->as('createProduct')
            ->for('Create a new product with nutritional values (per 100g). Use this when searchProduct returns no results. Estimate realistic nutritional values based on common food databases.')
            ->withStringParameter('name', 'Product name (in the language user used)')
            ->withNumberParameter('calories', 'Estimated calories per 100g')
            ->withNumberParameter('proteins', 'Estimated proteins per 100g in grams')
            ->withNumberParameter('fats', 'Estimated fats per 100g in grams')
            ->withNumberParameter('carbohydrates', 'Estimated carbohydrates per 100g in grams')
            ->using($this);
    }

    public function __invoke(
        string $name,
        float $calories,
        float $proteins,
        float $fats,
        float $carbohydrates
    ): string {
        $userId = auth()->id();

        if (! $userId) {
            return $this->toolResult('createProduct', [
                'success' => false,
                'message' => 'User must be authenticated to create products.',
            ]);
        }

        $product = Product::create([
            'title' => $name,
            'calories' => round($calories, 1),
            'proteins' => round($proteins, 1),
            'fats' => round($fats, 1),
            'carbohydrates' => round($carbohydrates, 1),
            'base' => true,
            'user_id' => $userId,
        ]);

        return $this->toolResult('createProduct', [
            'success' => true,
            'message' => "Created new product: {$name}",
            'product' => [
                'id' => $product->id,
                'title' => $product->title,
                'calories' => $product->calories,
                'proteins' => $product->proteins,
                'fats' => $product->fats,
                'carbohydrates' => $product->carbohydrates,
            ],
        ]);
    }

    private function toolResult(string $tool, array $payload): string
    {
        return json_encode($payload);
    }
}

