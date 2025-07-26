<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WardsSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('wards.sql');
        DB::unprepared(file_get_contents($path));
    }
}