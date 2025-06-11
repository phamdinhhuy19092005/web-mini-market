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

    /**
     * Search admins by query string (id, name, or email).
     *
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->adminRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    /**
     * Create a new admin.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            if (isset($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            }

            $roleIds = array_keys($attributes['roles'] ?? []);
            unset($attributes['roles']);

            $admin = $this->adminRepository->create($attributes);

            if (!empty($roleIds)) {
                $roles = Role::whereIn('id', $roleIds)->get();
                $admin->syncRoles($roles);
            }

            return $admin;
        });
    }

    /**
     * Find admin by ID with roles.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->adminRepository->model()::with('roles')->findOrFail($id);
    }

    /**
     * Show admin details (alias of find).
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * Update an existing admin.
     *
     * @param int $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->adminRepository->findOrFail($id);

            // Hash password if provided
            if (!empty($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            } else {
                unset($attributes['password']);
            }

            // Handle roles
            $roleIds = array_keys($attributes['roles'] ?? []);
            unset($attributes['roles']);

            // Update admin
            $this->adminRepository->update($id, $attributes);

            // Sync roles if provided
            if (!empty($roleIds)) {
                $roles = Role::whereIn('id', $roleIds)->get();
                $model->syncRoles($roles);
            }

            return $model->fresh();
        });
    }

    /**
     * Delete an admin by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $this->adminRepository->findOrFail($id);
            return $this->adminRepository->delete($id);
        });
    }
}
