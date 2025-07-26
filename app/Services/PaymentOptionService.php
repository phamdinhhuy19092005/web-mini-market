<?php

namespace App\Services;

use App\Repositories\Interfaces\PaymentOptionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Classes\ImageHelper;

class PaymentOptionService extends BaseService
{
    protected $paymentOptionRepository;

    public function __construct(PaymentOptionRepositoryInterface $paymentOptionRepository)
    {
        $this->paymentOptionRepository = $paymentOptionRepository;
    }

    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->paymentOptionRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }


    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('payment_option'))->delete($oldImagePath);
            }

            return (new ImageHelper('payment_option'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $imageHelper = new ImageHelper('payment_option');
            $attributes['logo'] = $imageHelper->upload($attributes['logo']);
            $attributes['type'] = $attributes['payment_type'] ?? null;
            $attributes['display_on_frontend'] = $attributes['display_on_frontend'] ?? 0;

            return $this->paymentOptionRepository->create($attributes);
        });
    }


    public function find($id)
    {
        return $this->paymentOptionRepository->find($id);
    }

    public function show($id)
    {
        return $this->paymentOptionRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->paymentOptionRepository->findOrFail($id);

            $attributes['logo'] = $this->handleImageUpdate($model->image, $attributes['logo'] ?? null);

            $attributes['display_on_frontend'] = isset($attributes['display_on_frontend']) ? (bool) $attributes['display_on_frontend'] : $model->display_on_frontend;
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->paymentOptionRepository->update($id, $attributes);
        });
    }
    

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $this->paymentOptionRepository->findOrFail($id);
            return $this->paymentOptionRepository->delete($id);
        });
    }
}
