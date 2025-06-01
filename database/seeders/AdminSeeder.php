<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = Admin::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            $admin = Admin::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123')
            ]);
        }
        
        $role = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'admin',
        ]);

        $role->syncPermissions(Permission::where('guard_name', 'admin')->get());

        $admin->assignRole($role);
    }
}