<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    #[Validate('nullable|string|max:100')]
    public ?string $search = null;

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

    public function delete(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
    }

    public function render()
    {
        $this->authorize('viewAny', Product::class);

        $userId = Auth::id();
        $products = Product::where(function ($query) use ($userId) {
            $query->whereNull('user_id')
                ->when($userId, function ($query) use ($userId) {
                    $query->orWhere('user_id', $userId);
                });
        })
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('proteins', 'like', '%' . $this->search . '%')
                    ->orWhere('fats', 'like', '%' . $this->search . '%')
                    ->orWhere('carbohydrates', 'like', '%' . $this->search . '%')
                    ->orWhere('calories', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->simplePaginate(25);

        return view('livewire.product-index', [
            'products' => $products,
        ]);
    }
}
