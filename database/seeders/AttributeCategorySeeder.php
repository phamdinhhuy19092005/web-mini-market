<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('attribute_categories')->truncate(); 

        DB::table('attribute_categories')->insert([
            ['attribute_id' => 1, 'category_id' => 4],
            ['attribute_id' => 1, 'category_id' => 5],
            ['attribute_id' => 1, 'category_id' => 6],
            ['attribute_id' => 1, 'category_id' => 7],
            ['attribute_id' => 1, 'category_id' => 8],
            ['attribute_id' => 1, 'category_id' => 9],
            ['attribute_id' => 1, 'category_id' => 10],
            ['attribute_id' => 1, 'category_id' => 11],
            ['attribute_id' => 1, 'category_id' => 12],
            ['attribute_id' => 1, 'category_id' => 13],
            ['attribute_id' => 2, 'category_id' => 14],
            ['attribute_id' => 2, 'category_id' => 15],
            ['attribute_id' => 2, 'category_id' => 16],
            ['attribute_id' => 2, 'category_id' => 17],
            ['attribute_id' => 2, 'category_id' => 18],
            ['attribute_id' => 2, 'category_id' => 21],
            ['attribute_id' => 2, 'category_id' => 50],
            ['attribute_id' => 2, 'category_id' => 51],
            ['attribute_id' => 2, 'category_id' => 53],
            ['attribute_id' => 2, 'category_id' => 54],
            ['attribute_id' => 2, 'category_id' => 57],
            ['attribute_id' => 2, 'category_id' => 59],
            ['attribute_id' => 2, 'category_id' => 60],
            ['attribute_id' => 2, 'category_id' => 61],
            ['attribute_id' => 2, 'category_id' => 65],
        ]);
    }
}
