<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;

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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    public function ingredients()
    {
        return $this->belongsToMany(Product::class, 'product_to_products', 'related_product_id', 'product_id')->withPivot('g');
    }

    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }
        return $query
            ->where(function ($query) use ($search) {
                $query->whereRaw("MATCH(title) AGAINST(? IN NATURAL LANGUAGE MODE)", [$search])
                    ->orWhere('title', 'LIKE', '%' . $search . '%'); // Додаємо частковий збіг
            })
            ->orderByRaw("
            CASE
                WHEN title = ? THEN 1   -- Повний збіг має найвищий пріоритет
                WHEN title LIKE ? THEN 2 -- Частковий збіг
                ELSE 3                  -- Інші результати
            END", [$search, '%' . $search . '%'])
            ->orderByRaw("LENGTH(title) ASC") // Найкоротші тайтли мають пріоритет
            ->orderByRaw("MATCH(title) AGAINST(? IN NATURAL LANGUAGE MODE) DESC", [$search]); // Релевантність
    }
}
