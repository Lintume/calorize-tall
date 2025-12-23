<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodIntake extends Model
{
    public $table = 'food_intake';

    public $fillable = [
        'product_id',
        'user_id',
        'g',
        'proteins',
        'fats',
        'carbohydrates',
        'calories',
        'type_food_intake',
        'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
