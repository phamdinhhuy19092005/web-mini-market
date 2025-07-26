<?php
namespace App\Services;

use App\Models\District;
use App\Repositories\Interfaces\ShippingZoneRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ShippingZoneService extends BaseService
{
    protected $shippingZoneRepository;

    public function __construct(ShippingZoneRepositoryInterface $shippingZoneRepository)
    {
        $this->shippingZoneRepository = $shippingZoneRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->shippingZoneRepository->model()::query()
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

            $attributes['supported_countries'] = $attributes['supported_countries'] ?? [];
            $attributes['supported_provinces'] = $attributes['supported_provinces'] ?? [];
            $attributes['supported_districts'] = $attributes['supported_districts'] ?? [];

            return $this->shippingZoneRepository->create($attributes);
        });
    }


    public function find($id)
    {
        return $this->shippingZoneRepository->find($id);
    }

    public function show($id)
    {
        return $this->shippingZoneRepository->findOrFail($id);
    }

    public function getFormattedDistricts()
    {
        return District::with('administrativeUnit')
            ->select('code', 'name', 'province_code', 'administrative_unit_id')
            ->get()
            ->map(function ($district) {
                return [
                    'code' => $district->code,
                    'name' => $district->name,
                    'province_code' => $district->province_code,
                    'full_name' => optional($district->administrativeUnit)->full_name . ' ' . $district->name,
                ];
            });
    }


    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $zone = $this->show($id);
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            $zone->update($attributes);

            return $zone;
        });
    }

    public function delete($id)
    {
        return $this->shippingZoneRepository->delete($id);
    }
}