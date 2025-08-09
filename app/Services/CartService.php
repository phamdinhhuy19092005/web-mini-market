<?php

namespace App\Services;

use App\Enum\CartItemStatusEnum;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

            $cartAttributes = collect($attributes)
                ->except('items')
                ->merge([
                    'uuid' => (string) Str::uuid(),
                    'ip_address' => request()->ip(),
                ])
                ->toArray();
            $cart = $this->CartRepository->create($cartAttributes);

            foreach ($items as $item) {
                $cart->items()->create([
                    'inventory_id' => $item['inventory_id'],
                    'currency_code' => $attributes['currency_code'],
                    'uuid' => Str::uuid(),
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                    'status' => $item['status'] ?? CartItemStatusEnum::PENDING,
                ]);
            }

            $cart->total_item = $cart->items()->count();
            $cart->total_quantity = $cart->items()->sum('quantity');
            $cart->save();

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
            // Fetch the cart
            $cart = $this->CartRepository->findOrFail($id);

            // Extract cart attributes, excluding items
            $cartAttributes = collect($attributes)
                ->except('items')
                ->toArray();

            // Update cart attributes
            $this->CartRepository->update($id, $cartAttributes);

            // Handle cart items
            $items = data_get($attributes, 'items', []);
            $existingItemIds = $cart->items->pluck('inventory_id')->toArray();
            $newItemIds = array_column($items, 'inventory_id');

            // Remove items not in the new list
            $cart->items()->whereNotIn('inventory_id', $newItemIds)->delete();

            // Add or update items
            foreach ($items as $index => $item) {
                $cart->items()->updateOrCreate(
                    ['inventory_id' => $item['inventory_id']],
                    [
                        'currency_code' => $cartAttributes['currency_code'] ?? $cart->currency_code,
                        'uuid' => Str::uuid(),
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total_price' => $item['price'] * $item['quantity'],
                        'status' => $item['status'] ?? CartItemStatusEnum::PENDING,
                    ]
                );
            }

            $cart->total_item = $cart->items()->count();
            $cart->total_quantity = $cart->items()->sum('quantity');
            $cart->total_price = $cart->items()->sum(DB::raw('price * quantity'));
            $cart->save();

            return $cart->fresh();
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            return $this->CartRepository->delete($id);
        });
    }
}
