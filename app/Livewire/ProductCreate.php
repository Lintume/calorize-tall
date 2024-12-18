<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCreate extends Component
{
    public ProductForm $form;

    #[On('search-updated')]
    public function searchUpdated(string $search): void
    {
        $this->form->title = $search;
    }

    public function save()
    {
        $this->authorize('create', Product::class);

        $validated = $this->validate();

        // search product with the same fields and user_id
        $productExists = Product::where('title', $validated['title'])
            ->where('proteins', $validated['proteins'])
            ->where('fats', $validated['fats'])
            ->where('carbohydrates', $validated['carbohydrates'])
            ->where('calories', $validated['calories'])
            ->where('user_id', Auth::id())
            ->first();

        if ($productExists) {
            $this->addError('title', __('Product already exists'));
            return;
        }

        $product = Auth::user()->products()->create($validated);

        $this->dispatch('productAdded', $product);
    }

    public function cancel(): void
    {
        $this->dispatch('productCreateCancelled');
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
