<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport2 implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new Product([
            'title' => $row['title'],
            'proteins' => $row['proteins'],
            'fats' => $row['fats'],
            'carbohydrates' => $row['carbohydrates'],
            'calories' => $row['calories'],
        ]);
    }

    public function chunkSize(): int
    {
        return 10; // Adjust the chunk size as needed
    }
}