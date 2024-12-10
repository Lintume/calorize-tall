<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;
    public function render()
    {
        $userId = Auth::id();
        $products = Product::whereNull('user_id')
            ->orWhere('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(25);

        return view('livewire.product-index', [
            'products' => $products,
        ]);
    }
}
