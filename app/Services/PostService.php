<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PostService extends BaseService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->postRepository->model()::query()
            ->with('postCategory')
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('post'))->delete($oldImagePath);
            }

            return (new ImageHelper('post'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $imageHelper = new ImageHelper('post');
            $attributes['image'] = $imageHelper->upload($attributes['image']);
            
            return $this->postRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->postRepository->find($id);
    }

    public function show($id)
    {
        return $this->postRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->postRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);

            // Update status if provided
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);

            return $this->postRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }
}
