<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [
        'title',
        'proteins',
        'fats',
        'carbohydrates',
        'calories',
        'base',
        'user_id',
        'total_weight'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Product::class, 'product_to_products', 'related_product_id', 'product_id')->withPivot('g');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('proteins', 'like', '%' . $search . '%')
                ->orWhere('fats', 'like', '%' . $search . '%')
                ->orWhere('carbohydrates', 'like', '%' . $search . '%')
                ->orWhere('calories', 'like', '%' . $search . '%');
        });
    }
}
