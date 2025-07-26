<?php
namespace App\Services;

use App\Repositories\Interfaces\ShippingRateRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ShippingRateService extends BaseService
{
    protected $shippingRateRepository;

    public function __construct(ShippingRateRepositoryInterface $shippingRateRepository)
    {
        $this->shippingRateRepository = $shippingRateRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->shippingRateRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->shippingRateRepository->create($attributes);
        });
    }


    public function find($id)
    {
        return $this->shippingRateRepository->find($id);
    }

    public function show($id)
    {
        return $this->shippingRateRepository->findOrFail($id);
    }


    public function update($id, array $attributes)
    {
        return DB::transaction(function () use ($id, $attributes) {
            $zone = $this->show($id);
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);
            $zone->update($attributes);

            return $zone;
        });
    }

    public function delete($id)
    {
        return $this->shippingRateRepository->delete($id);
    }
}
