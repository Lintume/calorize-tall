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

        // Use Meilisearch via Scout for smart search
        // Build filter: show public products OR user's own products
        $filter = $userId
            ? 'user_id IS NULL OR user_id = ' . $userId
            : 'user_id IS NULL';

        $products = Product::search($this->search)
            ->options([
                'filter' => $filter,
                'sort' => ['user_id:desc'],
            ])
            ->simplePaginate(5);

        return view('livewire.product-search', [
            'products' => $products,
        ]);
    }
}
