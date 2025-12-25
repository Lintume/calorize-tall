<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\Product;
use App\Services\DiaryAgent\DiaryAgentLogger;
use Illuminate\Support\Facades\Auth;
use Prism\Prism\Tool;

class SearchProductTool extends Tool
{
    public function __construct()
    {
        $this
            ->as('searchProduct')
            ->for('Search products by name. Returns up to 10 matching products with nutritional info, sorted with user recipes first. Use this before createProduct. If the list is ambiguous, ask a short clarification question or pick the best match based on the user message.')
            ->withStringParameter('query', 'Product name to search for (e.g., "apple", "яблуко", "chicken breast")')
            ->withBooleanParameter('onlyUserRecipes', 'If true, search only in user\'s own recipes. Default is false.')
            ->using($this);
    }

    public function __invoke(string $query, bool $onlyUserRecipes = false): string
    {
        DiaryAgentLogger::log('debug', 'DiaryAgent tool call', [
            'tool' => 'searchProduct',
            'args' => DiaryAgentLogger::payload([
                'query' => $query,
                'onlyUserRecipes' => $onlyUserRecipes,
            ]),
        ]);

        $userId = Auth::id();

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
            ->take(10)
            ->get();

        if ($products->isEmpty()) {
            return $this->toolResult('searchProduct', [
                'found' => false,
                'message' => "No products found matching '{$query}'. You may need to create this product using createProduct tool.",
                'query' => $query,
            ]);
        }

        return $this->toolResult('searchProduct', [
            'found' => true,
            'query' => $query,
            'count' => $products->count(),
            'products' => $products->values()->map(function (Product $product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'calories' => $product->calories,
                    'proteins' => $product->proteins,
                    'fats' => $product->fats,
                    'carbohydrates' => $product->carbohydrates,
                    'isUserRecipe' => $product->user_id !== null,
                ];
            })->toArray(),
        ]);
    }

    private function toolResult(string $tool, array $payload): string
    {
        DiaryAgentLogger::log('debug', 'DiaryAgent tool result', [
            'tool' => $tool,
            'result' => DiaryAgentLogger::payload($payload),
        ]);

        return json_encode($payload);
    }
}

