<?php
namespace App\Services;

use App\Repositories\Interfaces\WebsiteReviewRepositoryInterface;
use Illuminate\Support\Facades\DB;

class WebsiteReviewService extends BaseService
{
    protected $websiteReviewRepository;

    public function __construct(WebsiteReviewRepositoryInterface $websiteReviewRepository)
    {
        $this->websiteReviewRepository = $websiteReviewRepository;
    }

    

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $status = data_get($data, 'status');
        $perPage = data_get($data, 'per_page', 10);

        return $this->websiteReviewRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->when(isset($status), function ($q) use ($status) {
                $q->where('status_name', $status);
            })
            ->orderBy('id', 'desc') 
            ->paginate($perPage);
    }


    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->websiteReviewRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->websiteReviewRepository->find($id);
    }

    public function show($id)
    {
        return $this->websiteReviewRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->websiteReviewRepository->findOrFail($id);

            if (isset($attributes['status'])) {
                $attributes['status'] = (int) $attributes['status'];
            }

            return $this->websiteReviewRepository->update($id, $attributes);
        });
    }



    public function delete($id)
    {
        return $this->websiteReviewRepository->delete($id);
    }
}
