<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductUpdate extends Component
{
    public ProductForm $form;

    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->form->fill($product->toArray());
    }

    public function save()
    {
        $this->authorize('update', $this->product);

        $validated = $this->validate();

        // search product with the same fields and user_id
        $productExists = Product::where('title', $validated['title'])
            ->where('proteins', $validated['proteins'])
            ->where('fats', $validated['fats'])
            ->where('carbohydrates', $validated['carbohydrates'])
            ->where('calories', $validated['calories'])
            ->where('user_id', Auth::id())
            ->where('id', '!=', $this->product->id)
            ->first();

        if ($productExists) {
            $this->addError('title', __('Product already exists'));

            return;
        }

        $this->product->update($validated);

        return redirect()->route('product.index');
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
