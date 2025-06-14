<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PermissionSeeder::class,
            AdminSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,

            AdministrativeRegionsSeeder::class,
            AdministrativeUnitSeeder::class,

            ProvinceSeeder::class,
            DistrictSeeder::class,
        ]);


    }
}
