<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable, Sluggable;

    public $fillable = [
        'title',
        'proteins',
        'fats',
        'carbohydrates',
        'calories',
        'base',
        'user_id',
        'total_weight',
    ];

    /**
     * Cyrillic to Latin transliteration map (Ukrainian).
     */
    private const CYRILLIC_TO_LATIN = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'h', 'ґ' => 'g',
        'д' => 'd', 'е' => 'e', 'є' => 'ye', 'ж' => 'zh', 'з' => 'z',
        'и' => 'y', 'і' => 'i', 'ї' => 'yi', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p',
        'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
        'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
        'ь' => '', 'ю' => 'yu', 'я' => 'ya', 'ы' => 'y', 'э' => 'e',
        'ё' => 'yo', 'ъ' => '',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ],
        ];
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'title_transliterated' => $this->transliterate($this->title),
            'proteins' => (float) $this->proteins,
            'fats' => (float) $this->fats,
            'carbohydrates' => (float) $this->carbohydrates,
            'calories' => (float) $this->calories,
            'base' => (bool) $this->base,
            'user_id' => $this->user_id,
        ];
    }

    /**
     * Latin to Cyrillic transliteration map (for reverse mapping).
     * Multi-character sequences must come first for proper replacement.
     */
    private const LATIN_TO_CYRILLIC = [
        'shch' => 'щ', 'zh' => 'ж', 'kh' => 'х', 'ts' => 'ц',
        'ch' => 'ч', 'sh' => 'ш', 'yu' => 'ю', 'ya' => 'я',
        'ye' => 'є', 'yi' => 'ї', 'yo' => 'ё',
        'a' => 'а', 'b' => 'б', 'v' => 'в', 'h' => 'г', 'g' => 'ґ',
        'd' => 'д', 'e' => 'е', 'z' => 'з', 'y' => 'и', 'i' => 'і',
        'k' => 'к', 'l' => 'л', 'm' => 'м', 'n' => 'н', 'o' => 'о',
        'p' => 'п', 'r' => 'р', 's' => 'с', 't' => 'т', 'u' => 'у',
        'f' => 'ф',
    ];

    /**
     * Transliterate text from Cyrillic to Latin and vice versa.
     * Returns both versions for better search matching.
     */
    private function transliterate(string $text): string
    {
        $lowerText = mb_strtolower($text);

        // Convert Cyrillic to Latin (filter out empty mappings)
        $cyrToLat = array_filter(self::CYRILLIC_TO_LATIN, fn ($v) => $v !== '');
        $latinVersion = strtr($lowerText, $cyrToLat);

        // Convert Latin to Cyrillic
        $cyrillicVersion = strtr($lowerText, self::LATIN_TO_CYRILLIC);

        // Return both versions concatenated for search matching
        return trim($latinVersion.' '.$cyrillicVersion);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Product::class, 'product_to_products', 'related_product_id', 'product_id')->withPivot('g');
    }

    /**
     * @deprecated Use Scout search instead: Product::search($query)->get()
     */
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query
            ->where(function ($query) use ($search) {
                // FULLTEXT пошук
                $query->whereRaw('MATCH(title) AGAINST(? IN NATURAL LANGUAGE MODE)', [$search])
                    ->orWhere('title', 'LIKE', '%'.$search.'%'); // Частковий збіг

                // Якщо запит є числом, шукаємо в числових полях
                if (is_numeric($search)) {
                    $query->orWhere('proteins', $search)
                        ->orWhere('fats', $search)
                        ->orWhere('carbohydrates', $search)
                        ->orWhere('calories', $search);
                }
            })
            ->orderByRaw('
            CASE
                WHEN title = ? THEN 1   -- Повний збіг
                WHEN title LIKE ? THEN 2 -- Частковий збіг
                ELSE 3                  -- Інші результати
            END', [$search, '%'.$search.'%'])
            ->orderByRaw('LENGTH(title) ASC') // Найкоротші тайтли мають пріоритет
            ->orderByRaw('MATCH(title) AGAINST(? IN NATURAL LANGUAGE MODE) DESC', [$search]); // Релевантність
    }
}
