<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'proteins' => 'required|numeric|max:101',
            'fats' => 'required|numeric|max:101',
            'carbohydrates' => 'required|numeric|max:101',
            'calories' => 'required|numeric|max:950',
        ];
    }
}
