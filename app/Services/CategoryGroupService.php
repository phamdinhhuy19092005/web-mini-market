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

        return $this->categoryGroupRepository->model()::query()
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
            $attributes['image'] = (new ImageHelper('category_group'))->upload($attributes['image']);
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

    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $category_group = $this->show($id);

            // Handle image processing
            if ($image) {
                // Delete old image if it exists
                if ($category_group->image) {
                    (new ImageHelper('category'))->delete($category_group->image);
                }
                // Upload new image
                $attributes['image'] = (new ImageHelper('category'))->upload(['file' => $image]);
            } elseif (!data_get($attributes, 'image.path')) {
                // Keep existing image path if no new image is provided
                $attributes['image'] = $category_group->image;
            }

            // Update status, default to 0 if not provided
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);

            // Update model
            $category_group->update($attributes);
            return $category_group;
        });
    }

    public function delete($id)
    {
        return $this->categoryGroupRepository->delete($id);
    }
}