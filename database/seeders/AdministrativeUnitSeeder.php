<?php

namespace Database\Seeders;

use App\Models\AdministrativeUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrativeUnitSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('administrative_units')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $units = require database_path('data/administrative_units.php');
        AdministrativeUnit::insert($units);
    }
}