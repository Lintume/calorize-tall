<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return view('product.show', compact('product'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('product.create');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        if ($product->base === 0) {
            return redirect()->route('recipe.edit', $product);
        }

        return view('product.edit', compact('product'));
    }
}
