<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Closure;
use Illuminate\Support\Arr;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    protected $scopeQueries = null;

    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    abstract public function model(): string;

    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Khởi tạo instance của model.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel(): void
    {
        $this->model = app($this->model());
    }

    /**
     * Lấy tất cả bản ghi.
     *
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    /**
     * Tìm một bản ghi theo ID.
     *
     * @param mixed $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        if ($id instanceof Model) {
            return $id;
        }

        return $this->model->find($id);
    }

    /**
     * Tìm một bản ghi theo ID hoặc ném ngoại lệ.
     *
     * @param mixed $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOrFail($id): Model
    {
        if ($id instanceof Model) {
            return $id;
        }

        return $this->model->findOrFail($id);
    }

    /**
     * Tạo một bản ghi mới.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data = []): Model
    {
        return $this->model->create($data);
    }

    /**
     * Cập nhật một bản ghi theo ID.
     *
     * @param mixed $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data): Model
    {
        $model = $this->findOrFail($id);
        $model->update($data);
        return $model;
    }

    /**
     * Xóa một bản ghi theo ID.
     *
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool
    {
        $model = $this->findOrFail($id);
        return $model->delete();
    }
    

    /**
     * Add Query Scope.
     *
     * @return $this
     */
    public function scopeQuery(Closure $scope)
    {
        $this->scopeQueries = array_merge($this->scopeQueries, Arr::wrap($scope));

        return $this;
    }

    /**
     * Phân trang các bản ghi.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function modelScopes(array $scopes)
    {
        foreach ($scopes as $scope) {
            if (method_exists($this->model, $scope)) {
                $this->model = $this->model->$scope();
            }
        }
        return $this;
    }

}