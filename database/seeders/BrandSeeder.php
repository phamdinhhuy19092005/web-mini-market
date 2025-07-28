<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $brands = [
            ['name' => 'Gfood', 'image' => '', 'order' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MeatDeli', 'image' => '', 'order' => 2, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SG Food', 'image' => '', 'order' => 3, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'CP', 'image' => '', 'order' => 4, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ba Huân', 'image' => '', 'order' => 5, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chuối Pleiku Sweet', 'image' => '', 'order' => 6, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pretty Lady', 'image' => '', 'order' => 7, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cherry Mỹ', 'image' => '', 'order' => 8, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kiwi New Zealand', 'image' => '', 'order' => 9, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Táo Gala (NZ)', 'image' => '', 'order' => 10, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hugo Farm', 'image' => '', 'order' => 11, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'RCVN', 'image' => '', 'order' => 12, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Việt Hà', 'image' => '', 'order' => 13, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dalat GAP', 'image' => '', 'order' => 14, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tâm Việt', 'image' => '', 'order' => 15, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vinamilk', 'image' => '', 'order' => 16, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dutch Lady', 'image' => '', 'order' => 17, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TH True Milk', 'image' => '', 'order' => 18, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Meiji', 'image' => '', 'order' => 19, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Abbott', 'image' => '', 'order' => 20, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Oatside', 'image' => '', 'order' => 21, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => '137 Degrees', 'image' => '', 'order' => 22, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vitasoy', 'image' => '', 'order' => 23, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Almond Breeze', 'image' => '', 'order' => 24, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sahmyook', 'image' => '', 'order' => 25, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Omachi', 'image' => '', 'order' => 26, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => '3 Miền', 'image' => '', 'order' => 27, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kokomi', 'image' => '', 'order' => 28, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vifon', 'image' => '', 'order' => 29, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hảo Hảo', 'image' => '', 'order' => 30, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nam Ngư', 'image' => '', 'order' => 31, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chinsu', 'image' => '', 'order' => 32, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Neptune', 'image' => '', 'order' => 33, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tường An', 'image' => '', 'order' => 34, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ajinomoto', 'image' => '', 'order' => 35, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Coca-Cola', 'image' => '', 'order' => 36, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pepsi', 'image' => '', 'order' => 37, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Olong Tea Plus', 'image' => '', 'order' => 38, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vinamilk Super Nut', 'image' => '', 'order' => 39, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Red Bull', 'image' => '', 'order' => 40, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tearoma', 'image' => '', 'order' => 41, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cozy', 'image' => '', 'order' => 42, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dilmah', 'image' => '', 'order' => 43, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NesCafé', 'image' => '', 'order' => 44, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'The Coffee House', 'image' => '', 'order' => 45, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kinh Đô', 'image' => '', 'order' => 46, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Danisa', 'image' => '', 'order' => 47, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Solite', 'image' => '', 'order' => 48, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Orion', 'image' => '', 'order' => 49, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LU', 'image' => '', 'order' => 50, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('brands')->insert($brands);
    }
}
