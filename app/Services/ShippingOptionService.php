<?php
namespace App\Services;

use App\Repositories\Interfaces\ShippingOptionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ShippingOptionService extends BaseService
{
    protected $shippingOptionRepository;

    public function __construct(ShippingOptionRepositoryInterface $shippingOptionRepository)
    {
        $this->shippingOptionRepository = $shippingOptionRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->shippingOptionRepository->model()::query()
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
            return $this->shippingOptionRepository->create($attributes);
        });
    }


    public function find($id)
    {
        return $this->shippingOptionRepository->find($id);
    }

    public function show($id)
    {
        return $this->shippingOptionRepository->findOrFail($id);
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
        return $this->shippingOptionRepository->delete($id);
    }
}
