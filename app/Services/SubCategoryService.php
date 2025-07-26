<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SubCategoryService extends BaseService
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

       return $this->subCategoryRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%")
                    ->orWhere('status', 'like', "%$query%")
                    ->orWhere('slug', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->subCategoryRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->subCategoryRepository->find($id);
    }

    public function show($id)
    {
        return $this->subCategoryRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->subCategoryRepository->findOrFail($id);

            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->subCategoryRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->subCategoryRepository->delete($id);
    }

    public function restore($id)
    {
        $model = $this->subCategoryRepository->model()::withTrashed()->findOrFail($id);
        return $model->restore();
    }
}