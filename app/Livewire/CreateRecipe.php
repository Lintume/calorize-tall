<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateRecipe extends Component
{
    #[Validate('required|string|max:255')]
    public string $title = '';

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
                    'g' => $ingredient['grams'],
                ]);
            }
        });

        return redirect()->route('recipe.index');
    }

    public function render()
    {
        return view('livewire.recipe-form', [
            'selectedProducts' => collect(),
        ]);
    }
}
