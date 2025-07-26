<?php

namespace App\Services;

use App\Enum\PaymentTypeEnum;
use App\Models\PaymentProvider;
use App\Repositories\Interfaces\PaymentProviderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PaymentProviderService extends BaseService
{
    protected $paymentProviderRepository;

    public function __construct(PaymentProviderRepositoryInterface $paymentProviderRepository)
    {
        $this->paymentProviderRepository = $paymentProviderRepository;
    }

    public function getProviderByType(PaymentTypeEnum $type)
    {
        return PaymentProvider::where('payment_type', $type->value)->get();
    }

    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->paymentProviderRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function changeStatus($id, int $status)
    {
        return DB::transaction(function () use ($id, $status) {
            $provider = $this->paymentProviderRepository->findOrFail($id);
            $provider->update(['status' => $status]);
            return $provider->fresh();
        });
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->paymentProviderRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->paymentProviderRepository->find($id);
    }

    public function show($id)
    {
        return $this->paymentProviderRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $this->paymentProviderRepository->update($id, $attributes);
            return $this->paymentProviderRepository->findOrFail($id);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $this->paymentProviderRepository->findOrFail($id);
            return $this->paymentProviderRepository->delete($id);
        });
    }
}
