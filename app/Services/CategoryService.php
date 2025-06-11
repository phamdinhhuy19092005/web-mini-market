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

        return $this->categoryRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            // Configuration is set in filesystems.php
            $attributes['image'] = (new ImageHelper('category'))->upload($attributes['image']);
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

    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $category = $this->show($id);

            // Handle image processing
            if ($image) {
                // Delete old image if it exists
                if ($category->image) {
                    (new ImageHelper('category'))->delete($category->image);
                }
                // Upload new image
                $attributes['image'] = (new ImageHelper('category'))->upload(['file' => $image]);
            } elseif (!data_get($attributes, 'image.path')) {
                // Keep existing image path if no new image is provided
                $attributes['image'] = $category->image;
            }

            // Update status, default to 0 if not provided
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);

            // Update model
            $category->update($attributes);
            return $category;
        });
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}