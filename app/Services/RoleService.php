<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoleService extends BaseService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->roleRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    /**
     * Tạo mới role với permissions
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            // Tạo role mới
            $role = $this->roleRepository->create([
                'name' => $attributes['name'],
                'guard_name' => 'admin', 
            ]);

            // Gán permissions nếu có
            if (!empty($attributes['permissions'])) {
                $role->syncPermissions($attributes['permissions']);
            }

            return $role->fresh(); // Trả về role đã làm mới
        });
    }

    /**
     * Tìm role theo ID
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->roleRepository->find($id);
    }

    /**
     * Hiển thị role theo ID
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * Cập nhật role
     *
     * @param int $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $role = $this->roleRepository->findOrFail($id);

            // Cập nhật role
            $this->roleRepository->update($id, [
                'name' => $attributes['name'],
            ]);

            // Đồng bộ permissions nếu có
            if (isset($attributes['permissions'])) {
                $role->syncPermissions($attributes['permissions']);
            }

            return $role->fresh(); // Trả về role đã làm mới
        });
    }

    /**
     * Xóa role
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $role = $this->roleRepository->findOrFail($id);
            return $this->roleRepository->delete($id);
        });
    }
}