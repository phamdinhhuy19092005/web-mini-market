<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminService extends BaseService
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->adminRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            if (isset($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            }

            // Set default last_login_at nếu muốn
            if (!isset($attributes['last_login_at'])) {
                $attributes['last_login_at'] = null; 
            }

            // Lấy roleIds rồi xóa khỏi attributes
            $roleIds = array_keys($attributes['roles'] ?? []);
            unset($attributes['roles']);

            // Tạo admin
            $admin = $this->adminRepository->create($attributes);

            // Sync roles nếu có
            if (!empty($roleIds)) {
                $roles = Role::whereIn('id', $roleIds)->get();
                $admin->syncRoles($roles);
            }

            return $admin;
        });
    }

    public function find($id)
    {
        return $this->adminRepository->model()::with('roles')->findOrFail($id);
    }

    public function show($id)
    {
        return $this->find($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->adminRepository->findOrFail($id);

            if (!empty($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            } else {
                unset($attributes['password']);
            }

            $roleIds = array_keys($attributes['roles'] ?? []);
            unset($attributes['roles']);

            $this->adminRepository->update($id, $attributes);

            if (!empty($roleIds)) {
                $roles = Role::whereIn('id', $roleIds)->get();
                $model->syncRoles($roles);
            }

            return $model->fresh();
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $this->adminRepository->findOrFail($id);
            return $this->adminRepository->delete($id);
        });
    }
}
