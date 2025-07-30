<?php
namespace App\Services;

use App\Models\District;
use App\Models\User;
use App\Models\Ward;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AddressService extends BaseService
{
    protected $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->addressRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
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

    public function getFormattedWards()
    {
        return Ward::with('administrativeUnit')
            ->select('code', 'name', 'district_code', 'administrative_unit_id')
            ->get()
            ->map(function ($ward) {
                return [
                    'code' => $ward->code,
                    'name' => $ward->name,
                    'district_code' => $ward->district_code,
                    'full_name' => optional($ward->administrativeUnit)->full_name . ' ' . $ward->name,
                ];
            });
    }


    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $attributes['province_code'] = $attributes['supported_provinces'][0] ?? null;
            $attributes['district_code'] = $attributes['supported_districts'][0] ?? null;
            $attributes['ward_code'] = $attributes['supported_wards'][0] ?? null;

            $attributes['addressable_type'] = User::class; 
            $attributes['addressable_id'] = auth()->id();

            return $this->addressRepository->create($attributes);
        });
    }


    public function find($id)
    {
        return $this->addressRepository->find($id);
    }

    public function show($id)
    {
        return $this->addressRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {

            $this->addressRepository->findOrFail($id);

            return $this->addressRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->addressRepository->delete($id);
    }
}
