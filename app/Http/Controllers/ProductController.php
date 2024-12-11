<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

        return view('product.edit', compact('product'));
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        Auth::user()->products()->create($request->all());

        return redirect()->route('product.index');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->update($request->all());

        return redirect()->route('product.index');
    }
}
