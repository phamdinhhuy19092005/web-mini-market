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
            ->paginate($perPage);
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

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            // Configuration is set in filesystems.php
            $uploadResult = (new ImageHelper('category_group'))->upload($attributes['image']);
            $attributes['image'] = is_array($uploadResult) ? $uploadResult['path'] : $uploadResult;

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

    public function update($id, array $attributes = [], $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $model = $this->categoryGroupRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);

            // Update status if provided
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->categoryGroupRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->categoryGroupRepository->delete($id);
    }

    // Hàm khôi phục
    public function restore($id)
    {
        $model = $this->categoryGroupRepository->model()::withTrashed()->findOrFail($id);
        return $model->restore();
    }
}
