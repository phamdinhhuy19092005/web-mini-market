<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserActionLogTypeEnum;
use App\Models\Role;
use App\Models\UserActionLog;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->userRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    public function changeStatus($id, int $status, string $reason = null)
    {
        return DB::transaction(function () use ($id, $status, $reason) {
            $user = $this->userRepository->findOrFail($id);

            $user->update(['status' => $status]);

            UserActionLog::create([
                'user_id' => $user->id,
                'type' => $status === ActivationStatusEnum::ACTIVE
                    ? UserActionLogTypeEnum::ACTIVATE
                    : UserActionLogTypeEnum::DEACTIVATE,
                'reason' => $reason,
                'created_by_id' => auth()->id(),
                'created_by_type' => get_class(auth()->user()),
            ]);

            return $user;
        });
    }


    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            if (isset($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            }

            $roleIds = array_keys($attributes['roles'] ?? []);
            unset($attributes['roles']);

            $admin = $this->userRepository->create($attributes);

            if (!empty($roleIds)) {
                $roles = Role::whereIn('id', $roleIds)->get();
                $admin->syncRoles($roles);
            }

            return $admin;
        });
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function show($id)
    {
        return $this->userRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->userRepository->findOrFail($id);

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
            $this->userRepository->update($id, $attributes);

            // Sync roles if provided
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
            $this->userRepository->findOrFail($id);
            return $this->userRepository->delete($id);
        });
    }
}
