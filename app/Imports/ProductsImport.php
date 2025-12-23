<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'title' => $row['title'],
            'proteins' => $row['proteins'],
            'fats' => $row['fats'],
            'carbohydrates' => $row['carbohydrates'],
            'calories' => $row['calories'],
            'base' => $row['base'] ?? null,
            'user_id' => null,
            'total_weight' => $row['total_weight'] ?? null,
        ]);
    }
}