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

class UpdateRecipe extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Product $product;

    #[Validate('nullable|string|max:100')]
    public ?string $search = null;

    #[Validate('required|string|max:255')]
    public string $title = '';

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->title = $product->title;
    }

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
            $this->product->update([
                'title' => $this->title,
                'proteins' => $calculated['proteinsPer100g'],
                'fats' => $calculated['fatsPer100g'],
                'carbohydrates' => $calculated['carbohydratesPer100g'],
                'calories' => $calculated['kcalPer100g'],
                'total_weight' => $calculated['totalGrams'],
            ]);
            $selectedProdsSync = [];
            foreach ($selectedProducts as $ingredient) {
                $validator = Validator::make($ingredient, [
                    'id' => 'required|exists:products,id',
                    'grams' => 'required|numeric|min:0',
                ]);
                if ($validator->fails()) {
                    $this->setErrorBag($validator->errors());
                    throw new ValidationException($validator);
                }

                $selectedProdsSync[$ingredient['id']] = [
                    'g' => $ingredient['grams']
                ];
            }
            $this->product->ingredients()->sync($selectedProdsSync);
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

        $selectedProducts = $this->product->ingredients->map(function ($ingredient) {
            return [
                'id' => $ingredient->id,
                'title' => $ingredient->title,
                'proteins' => $ingredient->proteins,
                'fats' => $ingredient->fats,
                'carbohydrates' => $ingredient->carbohydrates,
                'calories' => $ingredient->calories,
                'grams' => $ingredient->pivot->g,
            ];
        })->toArray();

        return view('livewire.recipe-form', [
            'products' => $products,
            'selectedProducts' => $selectedProducts,
        ]);
    }
}
