<?php

namespace Database\Seeders;

use App\Models\AdministrativeRegion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrativeRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('administrative_regions')->delete();
        $regions = require database_path('data/administrative_regions.php');
        AdministrativeRegion::insert($regions);
    }
}