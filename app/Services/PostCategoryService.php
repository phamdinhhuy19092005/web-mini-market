<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\PostCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PostCategoryService extends BaseService
{
    protected $postCategoryRepository;

    public function __construct(PostCategoryRepositoryInterface $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->postCategoryRepository->model()::query()
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
                (new ImageHelper('post_category'))->delete($oldImagePath);
            }

            return (new ImageHelper('post_category'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            // Upload image
            $attributes['image'] = (new ImageHelper('post_category'))->upload($attributes['image']);
            return $this->postCategoryRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->postCategoryRepository->find($id);
    }

    public function show($id)
    {
        return $this->postCategoryRepository->findOrFail($id);
    }

    public function update($id, array $attributes, $image = null)
    {

        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->postCategoryRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);

            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;
            $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);

            return $this->postCategoryRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->postCategoryRepository->delete($id);
    }
}