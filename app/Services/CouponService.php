<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CouponService extends BaseService
{
    protected $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->couponRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }


public function searchByFrontend($data = [])
{
    $query = data_get($data, 'query');
    $perPage = data_get($data, 'per_page', 10);

    return $this->couponRepository->model()::query()
        ->where('status', \App\Enum\ActivationStatusEnum::ACTIVE)
        ->whereDate('end_date', '>=', now())
        ->when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%$query%")
              ->orWhere('code', 'like', "%$query%");
        })
        ->paginate($perPage);
}







    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->couponRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->couponRepository->find($id);
    }

    public function show($id)
    {
        return $this->couponRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            return $this->couponRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->couponRepository->delete($id);
    }
}
