<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::simplePaginate(25);
        return view('livewire.product-index', [
            'products' => $products,
        ]);
    }
}
