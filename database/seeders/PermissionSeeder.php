<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Model::unguard();

        DB::transaction(function () {
            $permissionNames = [
                // User
                'users.index',
                'users.show',
                'users.update',
                'users.action',
                // Admin
                'admins.index',
                'admins.store',
                'admins.update',
                'admins.export',
                // Role
                'roles.index',
                'roles.store',
                'roles.update',
                // System setting
                'system-settings.index',
                'system-settings.store',
                'system-settings.update',
                'system-settings.create-group',
                'system-settings.create-key',
                'system-settings.delete',
                'system-settings.clear-cache',
                'system-settings.import',
                'system-settings.export',
                // Category Groups
                'category-groups.index',
                'category-groups.store',
                'category-groups.update',
                'category-groups.delete',
                // Categories
                'categories.index',
                'categories.store',
                'categories.update',
                'categories.delete',
                // Products
                'products.index',
                'products.store',
                'products.update',
                'products.delete',
                // Attributes
                'attributes.index',
                'attributes.store',
                'attributes.update',
                // Attribute Values
                'attribute-values.index',
                'attribute-values.store',
                'attribute-values.update',
                'attribute-values.delete',
                // Inventories
                'inventories.index',
                'inventories.store',
                'inventories.update',
                'inventories.delete',
                // Banners
                'banners.index',
                'banners.store',
                'banners.show',
                'banners.update',
                'banners.delete',
                // Menu Groups
                'menu-groups.index',
                'menu-groups.store',
                'menu-groups.show',
                'menu-groups.update',
                'menu-groups.delete',
                // Menu Sub Groups
                'menu-sub-groups.index',
                'menu-sub-groups.store',
                'menu-sub-groups.show',
                'menu-sub-groups.update',
                'menu-sub-groups.delete',
            ];

            $permissions = [];
            foreach ($permissionNames as $permissionName) {
                Permission::updateOrInsert(
                    ['name' => $permissionName, 'guard_name' => 'admin'],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }


            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
