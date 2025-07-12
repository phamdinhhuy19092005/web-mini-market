<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('districts')->truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $districts = require database_path('data/districts.php');

        District::insert($districts);
    }
}
