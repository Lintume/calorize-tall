<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|numeric|max:101')]
    public float $proteins;

    #[Validate('required|numeric|max:101')]
    public float $fats;

    #[Validate('required|numeric|max:101')]
    public float $carbohydrates;

    #[Validate('required|numeric|max:950')]
    public float $calories;
}
