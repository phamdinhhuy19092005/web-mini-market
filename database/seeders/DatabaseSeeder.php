<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use WardsSeeder;

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
            CarrierSeeder::class,
            SubCategorySeeder::class,     

            FaqTopicSeeder::class,       
            FaqQuestionSeeder::class,
            PageSeeder::class,
            TermsCategorySeeder::class,
            TermsPostSeeder::class,

            WardsSeeder::class,
        ]);


    }
}
