<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Customer Supporter',
            'Category Analyst',
            'Content Creator',
        ];

        foreach ($roles as $roleName) {
            Role::updateOrInsert(
                ['name' => $roleName, 'guard_name' => 'admin'],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
