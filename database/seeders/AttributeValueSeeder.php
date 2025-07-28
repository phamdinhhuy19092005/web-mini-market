<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueSeeder extends Seeder
{
    public function run(): void
    {
       DB::table('attribute_values')->delete();


        DB::table('attribute_values')->insert([
            ['id' => 1, 'value' => '50g', 'attribute_id' => 1, 'color' => null, 'order' => 1, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-16 13:35:11', 'updated_at' => '2025-07-18 22:05:06'],
            ['id' => 2, 'value' => '100g', 'attribute_id' => 1, 'color' => null, 'order' => 2, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 21:53:35', 'updated_at' => '2025-07-18 21:53:35'],
            ['id' => 3, 'value' => '150g', 'attribute_id' => 1, 'color' => null, 'order' => 3, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 22:05:33', 'updated_at' => '2025-07-18 22:05:33'],
            ['id' => 4, 'value' => '200g', 'attribute_id' => 1, 'color' => null, 'order' => 4, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 22:08:08', 'updated_at' => '2025-07-18 22:08:21'],
            ['id' => 5, 'value' => '50ml', 'attribute_id' => 2, 'color' => null, 'order' => 1, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 22:14:51', 'updated_at' => '2025-07-18 22:14:51'],
            ['id' => 6, 'value' => '100ml', 'attribute_id' => 2, 'color' => null, 'order' => 2, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 22:15:51', 'updated_at' => '2025-07-18 22:15:51'],
            ['id' => 7, 'value' => '180ml', 'attribute_id' => 2, 'color' => null, 'order' => 3, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 22:16:07', 'updated_at' => '2025-07-19 17:09:39'],
            ['id' => 8, 'value' => '200ml', 'attribute_id' => 2, 'color' => null, 'order' => 4, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-18 22:16:28', 'updated_at' => '2025-07-19 17:10:00'],
            ['id' => 9, 'value' => 'Gói lẻ', 'attribute_id' => 3, 'color' => null, 'order' => 1, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:12:18', 'updated_at' => '2025-07-19 17:12:18'],
            ['id' => 10, 'value' => 'Hộp lẻ', 'attribute_id' => 3, 'color' => null, 'order' => 2, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:12:50', 'updated_at' => '2025-07-19 17:12:50'],
            ['id' => 11, 'value' => 'Chai lẻ', 'attribute_id' => 3, 'color' => null, 'order' => 3, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:13:10', 'updated_at' => '2025-07-19 17:13:10'],
            ['id' => 12, 'value' => 'Lon lẻ', 'attribute_id' => 3, 'color' => null, 'order' => 4, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:13:25', 'updated_at' => '2025-07-19 17:13:25'],
            ['id' => 13, 'value' => 'Lốc 2 hộp', 'attribute_id' => 3, 'color' => null, 'order' => 5, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:13:52', 'updated_at' => '2025-07-19 17:13:52'],
            ['id' => 14, 'value' => 'Lốc 4 hộp', 'attribute_id' => 3, 'color' => null, 'order' => 6, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:14:13', 'updated_at' => '2025-07-19 17:14:13'],
            ['id' => 15, 'value' => 'Lốc 6 hộp', 'attribute_id' => 3, 'color' => null, 'order' => 7, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:14:34', 'updated_at' => '2025-07-19 17:14:34'],
            ['id' => 16, 'value' => 'Lốc 8 hộp', 'attribute_id' => 3, 'color' => null, 'order' => 8, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:14:47', 'updated_at' => '2025-07-19 17:14:47'],
            ['id' => 17, 'value' => 'Lốc 12 lon', 'attribute_id' => 3, 'color' => null, 'order' => 9, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:15:05', 'updated_at' => '2025-07-19 17:15:05'],
            ['id' => 18, 'value' => 'Lốc 24 lon', 'attribute_id' => 3, 'color' => null, 'order' => 10, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:15:18', 'updated_at' => '2025-07-19 17:15:18'],
            ['id' => 19, 'value' => 'Lốc 48 hộp', 'attribute_id' => 3, 'color' => null, 'order' => 11, 'status' => 1, 'deleted_at' => null, 'created_at' => '2025-07-19 17:15:30', 'updated_at' => '2025-07-19 17:15:30'],
        ]);
    }
}
