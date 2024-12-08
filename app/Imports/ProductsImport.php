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
            'title' => $row['nazva'],
            'proteins' => $row['bilki'],
            'fats' => $row['ziri'],
            'carbohydrates' => $row['vuglevodi'],
            'calories' => $row['kaloriinist'],
        ]);
    }
}