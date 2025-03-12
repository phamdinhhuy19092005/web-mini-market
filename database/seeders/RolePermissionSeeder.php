<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Tạo roles với guard_name là admin
        $roles = [
            'Admin' => [
                'category-groups.index',
                'category-groups.create',
                'category-groups.show',
                'category-groups.edit',
                'category-groups.update',
                'category-groups.delete',
            ],
            'Customer Supporter' => [
                'category-groups.show', // Chỉ xem chi tiết
            ],
            'Category Analyst' => [
                'category-groups.index', // Xem danh sách
                'category-groups.show',  // Xem chi tiết
            ],
            'Content Creator' => [
                'category-groups.create', // Tạo mới
                'category-groups.show',   // Xem chi tiết
                'category-groups.edit',   // Sửa
                'category-groups.update', // Cập nhật
            ],
        ];

        // Tạo permissions
        $permissions = [
            'category-groups.index',
            'category-groups.create',
            'category-groups.show',
            'category-groups.edit',
            'category-groups.update',
            'category-groups.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // Tạo roles và gán permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'admin']);
            $role->syncPermissions($rolePermissions);
        }
    }
}