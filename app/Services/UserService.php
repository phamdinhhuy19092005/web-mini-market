<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserActionLogTypeEnum;
use App\Models\Role;
use App\Models\UserActionLog;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends BaseService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function searchByAdmin(array $data = []): LengthAwarePaginator
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->userRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%{$query}%");
            })
            ->paginate($perPage);
    }

    public function changeStatus(int $id, int $status, ?string $reason = null): Model
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

    public function create(array $attributes = []): Model
    {
        return DB::transaction(function () use ($attributes) {
            if (!empty($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            }

            $roleIds = array_keys($attributes['roles'] ?? []);
            unset($attributes['roles']);

            $user = $this->userRepository->create($attributes);

            if (!empty($roleIds)) {
                $roles = Role::whereIn('id', $roleIds)->get();
                $user->syncRoles($roles);
            }

            return $user;
        });
    }

    public function find(int $id): ?Model
    {
        return $this->userRepository->find($id);
    }

    public function show(int $id): Model
    {
        return $this->userRepository->findOrFail($id);
    }

    public function update(int $id, array $attributes = []): Model
    {
        return DB::transaction(function () use ($id, $attributes) {
            $this->userRepository->update($id, $attributes);
            return $this->userRepository->findOrFail($id);
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $this->userRepository->findOrFail($id);
            return $this->userRepository->delete($id);
        });
    }
}