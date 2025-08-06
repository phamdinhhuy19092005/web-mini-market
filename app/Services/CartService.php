<?php

namespace App\Services;

use App\Enum\CartItemStatusEnum;
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
                    ->orWhere('uuid', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $items = data_get($attributes, 'items', []);
            $cartAttributes = collect($attributes)->except('items')->toArray();

            $cart = $this->CartRepository->create($cartAttributes);

            foreach ($items as $item) {
                $cart->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'], 
                    'status' => $item['status'] ?? CartItemStatusEnum::PENDING,
                ]);
            }

            return $cart;
        });
    }

    public function find($id)
    {
        return $this->CartRepository->findOrFail($id);
    }

    public function show($id)
    {
        return $this->CartRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->CartRepository->findOrFail($id);
            return $this->CartRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            return $this->CartRepository->delete($id);
        });
    }
}
