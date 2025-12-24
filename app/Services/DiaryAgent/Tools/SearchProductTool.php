<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\Product;
use Prism\Prism\Tool;

class SearchProductTool extends Tool
{
    public function __construct()
    {
        $this
            ->as('searchProduct')
            ->for('Search for a single product by name. Returns the best matching product with nutritional info. Call this tool multiple times for multiple products.')
            ->withStringParameter('query', 'Product name to search for (e.g., "apple", "яблуко", "chicken breast")')
            ->withBooleanParameter('onlyUserRecipes', 'If true, search only in user\'s own recipes. Default is false.')
            ->using($this);
    }

    public function __invoke(string $query, bool $onlyUserRecipes = false): string
    {
        $userId = auth()->id();

        // Build Meilisearch filter
        if ($onlyUserRecipes) {
            $filter = "user_id = {$userId}";
        } else {
            $filter = $userId
                ? "user_id IS NULL OR user_id = {$userId}"
                : 'user_id IS NULL';
        }

        $products = Product::search($query)
            ->options([
                'filter' => $filter,
                'sort' => ['user_id:desc'],
            ])
            ->take(1)
            ->get();

        if ($products->isEmpty()) {
            return json_encode([
                'found' => false,
                'message' => "No product found matching '{$query}'. You may need to create this product using createProduct tool.",
                'query' => $query,
            ]);
        }

        $product = $products->first();

        return json_encode([
            'found' => true,
            'product' => [
                'id' => $product->id,
                'title' => $product->title,
                'calories' => $product->calories,
                'proteins' => $product->proteins,
                'fats' => $product->fats,
                'carbohydrates' => $product->carbohydrates,
                'isUserRecipe' => $product->user_id !== null,
            ],
        ]);
    }
}

