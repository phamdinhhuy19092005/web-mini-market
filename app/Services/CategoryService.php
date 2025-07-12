<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);
        $orderColumn = data_get($data, 'order_column', 'id'); 
        $orderDir = data_get($data, 'order_dir', 'desc');     

        $allowedColumns = ['id', 'name', 'status', 'slug'];
        if (!in_array($orderColumn, $allowedColumns)) {
            $orderColumn = 'id';
        }

        return $this->categoryRepository->model()::with('categoryGroup')
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%")
                ->orWhereHas('categoryGroup', function ($subQuery) use ($query) {
                    $subQuery->where('name', 'like', "%$query%");
                });
            })
            ->orderBy($orderColumn, $orderDir)
            ->paginate($perPage);
    }


    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('category'))->delete($oldImagePath);
            }

            return (new ImageHelper('category'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $imageHelper = new ImageHelper('category');
            $attributes['image'] = $imageHelper->upload($attributes['image']);
            return $this->categoryRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function show($id)
    {
        return $this->categoryRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->categoryRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);

            // Update status if provided
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->categoryRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}