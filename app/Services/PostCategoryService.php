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



    public function create(array $attributes = [])
    {
        return DB::transaction(function() use ($attributes) {
    
            $attributes['image'] = (new ImageHelper('posts'))->upload($attributes['image']);

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
        return DB::transaction(function () use ($id, $attributes, $image) {
            $category = $this->show($id);

            if ($image) {
                if ($category->image) {
                    (new ImageHelper('posts'))->delete($category->image);
                }
                $attributes['image'] = (new ImageHelper('posts'))->upload(['file' => $image]);
            } elseif (! data_get($attributes, 'image.path')) {
               
                $attributes['image'] = data_get($attributes, 'image.path');
            } else {
                $attributes['image'] = $category->image;
            }

            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);


            // Cập nhật model
            $category->update($attributes);

            return $category;
        });
    }

    public function delete($id)
    {
        return $this->postCategoryRepository->delete($id);
    }
}
