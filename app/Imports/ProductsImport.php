<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToArray, WithChunkReading, WithHeadingRow
{
    public function array(array $rows)
    {
        $data = [];
        $now = now();

        foreach ($rows as $row) {
            $data[] = [
                'title' => $row['title'],
                'slug' => $row['slug'],
                'proteins' => $row['proteins'],
                'fats' => $row['fats'],
                'carbohydrates' => $row['carbohydrates'],
                'calories' => $row['calories'],
                'base' => $row['base'] ?? null,
                'user_id' => null,
                'total_weight' => $row['total_weight'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('products')->insert($data);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
