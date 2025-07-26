<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\CategoryGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryGroupService extends BaseService
{
    protected $categoryGroupRepository;

    public function __construct(CategoryGroupRepositoryInterface $categoryGroupRepository)
    {
        $this->categoryGroupRepository = $categoryGroupRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->categoryGroupRepository->model()::with('categories')
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
            $imageResult = (new ImageHelper('category_group'))->upload($attributes['image']);
            $coverResult = (new ImageHelper('category_group'))->upload($attributes['cover']);

            $attributes['image'] = is_array($imageResult) ? $imageResult['path'] : $imageResult;
            $attributes['cover'] = is_array($coverResult) ? $coverResult['path'] : $coverResult;

            return $this->categoryGroupRepository->create($attributes);
        });
    }


    public function find($id)
    {
        return $this->categoryGroupRepository->find($id);
    }

    public function show($id)
    {
        return $this->categoryGroupRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->categoryGroupRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);
            $attributes['cover'] = $this->handleImageUpdate($model->cover, $attributes['cover'] ?? null);
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->categoryGroupRepository->update($id, $attributes);
        });
    }


    public function delete($id)
    {
        return $this->categoryGroupRepository->delete($id);
    }

    public function restore($id)
    {
        $model = $this->categoryGroupRepository->model()::withTrashed()->findOrFail($id);
        return $model->restore();
    }

    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('category_group'))->delete($oldImagePath);
            }

            return (new ImageHelper('category_group'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }
}
