<?php
namespace App\Services;

use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PageService extends BaseService
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);
        return $this->pageRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }




    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $user = auth('admin')->user();

            $attributes += [
                'created_by_type' => get_class($user),
                'created_by_id'   => $user->id,
                'updated_by_type' => get_class($user),
                'updated_by_id'   => $user->id,
            ];

            return $this->pageRepository->create($attributes);
        });
    }





    public function find($id)
    {
        return $this->pageRepository->find($id);
    }

    public function show($id)
    {
        return $this->pageRepository->findOrFail($id);
    }

   public function update($id, array $attributes)
    {
        return DB::transaction(function () use ($id, $attributes) {
            $post = $this->show($id);

            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);

            $post->update($attributes);

            return $post;
        });
    }


    public function delete($id)
    {
        return $this->pageRepository->delete($id);
    }
}
