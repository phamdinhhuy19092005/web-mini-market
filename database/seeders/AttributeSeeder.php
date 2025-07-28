<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('attributes')->insert([
            [
                'name' => 'Khối lượng / Trọng lượng',
                'attribute_type' => 1,
                'order' => 1,
                'status' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-07-13 10:59:10'),
                'updated_at' => Carbon::parse('2025-07-13 10:59:10'),
            ],
            [
                'name' => 'Dung tích',
                'attribute_type' => 1,
                'order' => 2,
                'status' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-07-13 11:01:20'),
                'updated_at' => Carbon::parse('2025-07-13 11:01:20'),
            ],
            [
                'name' => 'Quy cách đóng gói',
                'attribute_type' => 1,
                'order' => 3,
                'status' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-07-13 11:01:50'),
                'updated_at' => Carbon::parse('2025-07-13 11:01:50'),
            ],
            [
                'name' => 'Hương vị',
                'attribute_type' => 1,
                'order' => 4,
                'status' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-07-13 11:02:52'),
                'updated_at' => Carbon::parse('2025-07-13 11:02:52'),
            ],
            [
                'name' => 'Số lượng trong gói',
                'attribute_type' => 1,
                'order' => 5,
                'status' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-07-13 11:04:09'),
                'updated_at' => Carbon::parse('2025-07-13 11:04:09'),
            ],
            [
                'name' => 'Hạn sử dụng',
                'attribute_type' => 1,
                'order' => 5, // Nếu đây là lỗi, bạn có thể sửa thành 6
                'status' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-07-13 11:04:47'),
                'updated_at' => Carbon::parse('2025-07-13 11:04:47'),
            ],
        ]);
    }
}
