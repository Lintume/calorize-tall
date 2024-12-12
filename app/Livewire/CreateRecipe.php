<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CreateRecipe extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Validate('nullable|string|max:100')]
    public ?string $search = null;

    public array $selectedProducts;

    #[Validate('required|string|max:255')]
    public string $title = '';

    public function updatedSearch($field)
    {
        try {
            $this->validateOnly('search');
            $this->resetPage();
        } catch (ValidationException $e) {
            $this->reset($field);
            return;
        }
    }

    public function save()
    {
        $this->validate();


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
