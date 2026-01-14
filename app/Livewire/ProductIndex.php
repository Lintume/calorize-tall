<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    #[Validate('nullable|string|max:100')]
    public ?string $search = null;

    public bool $isRecipesRequest = false;

    public function mount()
    {
        $this->isRecipesRequest = request()->routeIs('recipe.index');
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

    public function delete(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
    }

    public function render()
    {
        $this->authorize('viewAny', Product::class);

        $userId = Auth::id();
        $baseFilter = $this->isRecipesRequest ? 'base = false' : 'base = true';

        // Use Meilisearch via Scout for smart search
        if (! empty($this->search)) {
            // Build filter: (public OR user's own) AND base type
            $userFilter = $userId
                ? '(user_id IS NULL OR user_id = '.$userId.')'
                : 'user_id IS NULL';

            $products = Product::search($this->search)
                ->options([
                    'filter' => $userFilter.' AND '.$baseFilter,
                    'sort' => ['user_id:desc'],
                ])
                ->simplePaginate(25);
        } else {
            // No search query - use database for empty state
            $products = Product::where(function ($query) use ($userId) {
                $query->whereNull('user_id')
                    ->when($userId, function ($query) use ($userId) {
                        $query->orWhere('user_id', $userId);
                    });
            })
                ->where('base', ! $this->isRecipesRequest)
                ->orderBy('user_id', 'desc')
                ->when(! $this->isRecipesRequest, function ($query) { // Randomize products only when no search query is provided
                    $query->orderByRaw('rand()');
                })
                ->simplePaginate(25);
        }

        return view('livewire.product-index', [
            'products' => $products,
        ]);
    }
}
