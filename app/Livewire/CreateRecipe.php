<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class CreateRecipe extends Component
{
    use WithPagination;

    #[Validate('nullable|string|max:100')]
    public ?string $search = null;

    public Collection $selectedProducts;

    #[Validate('required|string|max:255')]
    public string $title = '';

    public function mount()
    {
        $this->selectedProducts = collect();
    }

    public function updated($field)
    {
        try {
            $this->validate();
            $this->resetPage();
        } catch (ValidationException $e) {
            $this->reset($field);
            return;
        }
    }

    public function addProduct(Product $product): void
    {
        $this->selectedProducts->push($product);
    }

    public function delete(Product $product)
    {
        $this->selectedProducts = $this->selectedProducts->reject(function ($selectedProduct) use ($product) {
            return $selectedProduct->id === $product->id;
        });
    }

    public function render()
    {
        $userId = Auth::id();
        $products = Product::where(function ($query) use ($userId) {
            $query->whereNull('user_id')
                ->when($userId, function ($query) use ($userId) {
                    $query->orWhere('user_id', $userId);
                });
        })->search($this->search)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(5);

        return view('livewire.create-recipe', [
            'products' => $products,
        ]);
    }
}
