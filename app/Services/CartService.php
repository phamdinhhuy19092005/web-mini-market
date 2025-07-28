<?php

namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CartService extends BaseService
{
    protected $CartRepository;

    public function __construct(CartRepositoryInterface $CartRepository)
    {
        $this->CartRepository = $CartRepository;
    }

    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->CartRepository->model()::query()
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
            $imageHelper = new ImageHelper('banner');

            if (isset($attributes['desktop_image'])) {
                $attributes['desktop_image'] = $imageHelper->upload($attributes['desktop_image']);
            }

            if (isset($attributes['mobile_image'])) {
                $attributes['mobile_image'] = $imageHelper->upload($attributes['mobile_image']);
            }

            return $this->CartRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->CartRepository->findOrFail($id);
    }

    public function show($id)
    {
        return $this->find($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->CartRepository->findOrFail($id);
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->CartRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $model = $this->CartRepository->findOrFail($id);

            if ($model->desktop_image) {
                (new ImageHelper('banner'))->delete($model->desktop_image);
            }

            if ($model->mobile_image) {
                (new ImageHelper('banner'))->delete($model->mobile_image);
            }

            return $this->CartRepository->delete($id);
        });
    }
}
