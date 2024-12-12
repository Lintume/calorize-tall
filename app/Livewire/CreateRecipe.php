<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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

    /**
     * @throws ValidationException
     */
    public function save(array $selectedProducts, array $calculated)
    {
        $this->validate();

        $validator = Validator::make($calculated, [
            'proteinsPer100g' => 'required|numeric|min:0',
            'fatsPer100g' => 'required|numeric|min:0',
            'carbohydratesPer100g' => 'required|numeric|min:0',
            'kcalPer100g' => 'required|numeric|min:0',
            'totalGrams' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            throw new ValidationException($validator);
        }

        DB::transaction(function () use ($selectedProducts, $calculated) {
            $product = Product::create([
                'title' => $this->title,
                'proteins' => $calculated['proteinsPer100g'],
                'fats' => $calculated['fatsPer100g'],
                'carbohydrates' => $calculated['carbohydratesPer100g'],
                'calories' => $calculated['kcalPer100g'],
                'base' => false,
                'user_id' => Auth::id(),
                'total_weight' => $calculated['totalGrams'],
            ]);
            foreach ($selectedProducts as $ingredient) {
                $validator = Validator::make($ingredient, [
                    'id' => 'required|exists:products,id',
                    'grams' => 'required|numeric|min:0',
                ]);
                if ($validator->fails()) {
                    $this->setErrorBag($validator->errors());
                    throw new ValidationException($validator);
                }

                DB::table('product_to_products')->insert([
                    'related_product_id' => $product->id,
                    'product_id' => $ingredient['id'],
                    'g' => $ingredient['grams']
                ]);
            }
        });

        return redirect()->route('recipe.index');
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
