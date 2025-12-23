<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithoutUrlPagination, WithPagination;

    #[Validate('nullable|string|max:100')]
    public ?string $search = null;

    public function updatedSearch($field)
    {
        try {
            $this->validateOnly('search');
            $this->resetPage();
            $this->dispatch('search-updated', $this->search);
        } catch (ValidationException $e) {
            $this->reset($field);

            return;
        }
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
            ->orderBy('user_id', 'desc')
            ->simplePaginate(5);

        return view('livewire.product-search', [
            'products' => $products,
        ]);
    }
}
