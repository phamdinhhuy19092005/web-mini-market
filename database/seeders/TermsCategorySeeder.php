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
            'Bài mới lên',
            'Công thức nấu ăn',
            'Món ngon',
            'Review',
            'Sinh Nhật Uchi Mart',
            'Mẹo vặt',
            'Trung Thu',
            'Từ điển trái cây',
        ];

        foreach ($categories as $index => $name) {
            $slug = Str::slug($name);

            DB::table('post_categories')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'image' => null,
                    'description' => "Danh mục: $name",
                    'order' => $index + 1,
                    'display_on_frontend' => 1,
                    'meta_title' => "$name | Uchi Mart",
                    'meta_description' => "Thông tin về $name tại Uchi Mart",
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
