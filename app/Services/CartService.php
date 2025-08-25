<?php

namespace App\Services;

use App\Enum\CartItemStatusEnum;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Inventory;
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

    public function getCartsWithItemsByUserId(int $userId)
    {
        return Cart::with(['items.inventory'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getOrCreateCart($user, $cartUuid, $ip)
    {
        if ($user) {
            return Cart::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'uuid' => Str::uuid(),
                    'currency_code' => 'VND',
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                    'ip_address' => $ip,
                ]
            );
        } elseif ($cartUuid) {
            return Cart::firstOrCreate(
                ['uuid' => $cartUuid],
                [
                    'currency_code' => 'VND',
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                    'ip_address' => $ip,
                ]
            );
        }

        return Cart::create([
            'uuid' => Str::uuid(),
            'currency_code' => 'VND',
            'total_item' => 0,
            'total_quantity' => 0,
            'total_price' => 0,
            'ip_address' => $ip,
        ]);
    }

    public function addOrUpdateItem(Cart $cart, $inventoryId, $quantity)
    {
        $inventory = Inventory::findOrFail($inventoryId);

        if ($inventory->stock_quantity < $quantity) {
            return ['error' => 'Số lượng tồn kho không đủ'];
        }

        $price = $inventory->offer_price ?? $inventory->sale_price;

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('inventory_id', $inventoryId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($inventory->stock_quantity < $newQuantity) {
                return ['error' => 'Số lượng tồn kho không đủ cho số lượng mới'];
            }
            $cartItem->quantity = $newQuantity;
            $cartItem->total_price = $newQuantity * $price;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'inventory_id' => $inventoryId,
                'ip_address' => request()->ip(),
                'uuid' => Str::uuid(),
                'currency_code' => $cart->currency_code,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $quantity * $price,
                'status' => 1,
            ]);
        }

        $this->updateCartTotals($cart);

        return ['cart' => $cart->load('items.inventory')];
    }

    public function updateCartTotals(Cart $cart)
    {
        $cart->total_item = $cart->items()->count();
        $cart->total_quantity = $cart->items()->sum('quantity');
        $cart->total_price = $cart->items()->sum('total_price');
        $cart->save();
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

            $this->updateCartTotals($cart);

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
            $cart = $this->CartRepository->findOrFail($id);

            $cartAttributes = collect($attributes)
                ->except('items')
                ->toArray();

            $this->CartRepository->update($id, $cartAttributes);

            $items = data_get($attributes, 'items', []);
            $newItemIds = array_column($items, 'inventory_id');

            $cart->items()->whereNotIn('inventory_id', $newItemIds)->delete();

            foreach ($items as $item) {
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

            $this->updateCartTotals($cart);

            return $cart->fresh();
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            return $this->CartRepository->delete($id);
        });
    }

    public function removeItem(Cart $cart, $inventoryId)
    {
        $cartItem = $cart->items()
            ->where('inventory_id', $inventoryId)
            ->firstOrFail();

        $cartItem->delete();

        $this->updateCartTotals($cart);

        return $cart->load('items.inventory');
    }

    public function clearCart(Cart $cart)
    {
        $cart->items()->delete();
        $this->updateCartTotals($cart);
        return $cart;
    }

}
