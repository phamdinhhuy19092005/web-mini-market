<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Bảo mật',
            'Chính sách giao hàng',
            'Chính sách thanh toán',
            'Chính sách đổi trả',
            'Hướng dẫn mua hàng',
            'Điều khoản',
        ];

        foreach ($categories as $index => $name) {
            $slug = Str::slug($name);

            DB::table('post_categories')->updateOrInsert(
                ['slug' => $slug], // Điều kiện kiểm tra trùng
                [
                    'name' => $name,
                    'image' => null,
                    'description' => "Danh mục: $name",
                    'order' => $index + 1,
                    'display_on_frontend' => 1,
                    'meta_title' => "$name | Uchi Mart",
                    'meta_description' => "Thông tin về $name tại Uchi Mart",
                    'status' => 1,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
