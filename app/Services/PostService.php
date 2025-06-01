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
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }



    public function create(array $attributes = [])
    {
        return DB::transaction(function() use ($attributes) {

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

    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $post = $this->show($id);

            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);

            $post->update($attributes);

            return $post;
        });
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }
}
