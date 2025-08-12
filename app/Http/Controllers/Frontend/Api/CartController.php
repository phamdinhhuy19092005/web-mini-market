<?php

namespace App\Http\Controllers\Frontend\Api;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Inventory;
use App\Services\CartService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Log;

class CartController extends BaseApiController
{
    // Lấy giỏ hàng hiện tại theo user hoặc uuid
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $cart = Cart::with('items.inventory')->where('user_id', $user->id)->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => $user->id,
                    'uuid' => Str::uuid(),             
                    'currency_code' => 'VND',          
                    'ip_address' => request()->ip(),
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                ]);
            }
            return response()->json(['cart' => $cart]); 
        }

        return response()->json(['cart' => null]);
    }

    // Đồng bộ giỏ hàng từ localStorage FE gửi lên
    public function syncCart(Request $request)
    {
        $user = $request->user();
        $cartUuid = $request->input('cart_uuid');
        $items = $request->input('items');

        if (!$items || !is_array($items)) {
            return response()->json(['message' => 'Invalid cart items'], 400);
        }

        // Xác thực token nếu header Authorization có token nhưng chưa có $user
        if ($request->hasHeader('Authorization') && !$user) {
            $token = $request->bearerToken();
            if ($token) {
                $personalAccessToken = PersonalAccessToken::findToken($token);
                if ($personalAccessToken && $personalAccessToken->tokenable_type === 'App\\Models\\User') {
                    $user = $personalAccessToken->tokenable;
                } else {
                    return response()->json(['message' => 'Unauthorized: Invalid token'], 401);
                }
            } else {
                return response()->json(['message' => 'Unauthorized: Missing token'], 401);
            }
        }

        if ($user) {
            // Lấy giỏ hàng user hiện tại (nếu có)
            $userCart = Cart::with('items')->where('user_id', $user->id)->first();

            if ($cartUuid) {
                $guestCart = Cart::with('items')->where('uuid', $cartUuid)->first();

                if ($guestCart) {
                    if ($userCart) {
                        // Merge items guestCart vào userCart
                        foreach ($guestCart->items as $item) {
                            $existing = $userCart->items->firstWhere('inventory_id', $item->inventory_id);
                            if ($existing) {
                                $existing->quantity += $item->quantity;
                                $existing->total_price = $existing->quantity * $existing->price;
                                $existing->save();
                            } else {
                                $userCart->items()->create([
                                    'inventory_id' => $item->inventory_id,
                                    'ip_address' => $request->ip(),
                                    'uuid' => Str::uuid(),
                                    'currency_code' => $userCart->currency_code,
                                    'quantity' => $item->quantity,
                                    'price' => $item->price,
                                    'total_price' => $item->total_price,
                                    'status' => 1,
                                ]);
                            }
                        }
                        // Xóa giỏ guest sau khi merge
                        $guestCart->items()->delete();
                        $guestCart->delete();
                    } else {
                        // Nếu chưa có giỏ user thì gán guestCart thành userCart
                        $guestCart->user_id = $user->id;
                        $guestCart->ip_address = $request->ip();
                        $guestCart->save();
                        $userCart = $guestCart;
                    }
                }
            }

            // Nếu user chưa có giỏ hàng thì tạo mới
            if (!$userCart) {
                $userCart = Cart::create([
                    'user_id' => $user->id,
                    'uuid' => Str::uuid(),
                    'currency_code' => 'VND',
                    'ip_address' => $request->ip(),
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                ]);
            }

            $cart = $userCart;
        } else {
            // User chưa login thì xử lý như cũ (lấy hoặc tạo cart guest)
            if ($cartUuid) {
                $cart = Cart::firstOrCreate(
                    ['uuid' => $cartUuid],
                    [
                        'currency_code' => 'VND',
                        'total_item' => 0,
                        'total_quantity' => 0,
                        'total_price' => 0,
                        'ip_address' => $request->ip(),
                    ]
                );
            } else {
                $cart = Cart::create([
                    'uuid' => Str::uuid(),
                    'currency_code' => 'VND',
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                    'ip_address' => $request->ip(),
                ]);
            }
        }

        // Lấy các item hiện có trong cart (user hoặc guest)
        $existingItems = $cart->items()->get()->keyBy('inventory_id');

        DB::transaction(function () use ($cart, $items, $existingItems) {
            foreach ($items as $item) {
                $inventoryId = $item['inventory_id'];
                $quantity = max(0, (int)$item['quantity']);

                if ($existingItems->has($inventoryId)) {
                    $cartItem = $existingItems->get($inventoryId);
                    if ($quantity == 0) {
                        $cartItem->delete();
                    } else {
                        $cartItem->quantity = $quantity;
                        $cartItem->total_price = $quantity * $cartItem->price;
                        $cartItem->save();
                    }
                } else {
                    if ($quantity > 0) {
                        $inventory = Inventory::find($inventoryId);
                        if (!$inventory) {
                            continue;
                        }

                        CartItem::create([
                            'cart_id' => $cart->id,
                            'inventory_id' => $inventoryId,
                            'ip_address' => request()->ip(),
                            'uuid' => Str::uuid(),
                            'currency_code' => $cart->currency_code,
                            'quantity' => $quantity,
                            'price' => $inventory->sale_price ?? $inventory->offer_price,
                            'total_price' => $quantity * ($inventory->sale_price ?? $inventory->offer_price),
                            'status' => 1,
                        ]);
                    }
                }
            }
        });

        $this->updateCartTotals($cart);

        $response = response()->json([
            'cart' => $cart->load('items.inventory'),
        ]);

        if (!$user) {
            $response->cookie('cart_uuid', $cart->uuid, 60 * 24 * 30);
        }

        return $response;
    }

    public function guestSyncCart(Request $request)
    {
        $cartUuid = $request->input('cart_uuid');
        $items = $request->input('items');

        if (!$items || !is_array($items)) {
            return response()->json(['message' => 'Invalid cart items'], 400);
        }

        $cart = null;

        if ($cartUuid) {
            $cart = Cart::firstOrCreate(
                ['uuid' => $cartUuid],
                [
                    'currency_code' => 'VND',
                    'total_item' => 0,
                    'total_quantity' => 0,
                    'total_price' => 0,
                    'ip_address' => $request->ip(),
                ]
            );
        } else {
            $cart = Cart::create([
                'uuid' => Str::uuid(),
                'currency_code' => 'VND',
                'total_item' => 0,
                'total_quantity' => 0,
                'total_price' => 0,
                'ip_address' => $request->ip(),
            ]);
        }

        $existingItems = $cart->items()->get()->keyBy('inventory_id');

        DB::transaction(function () use ($cart, $items, $existingItems) {
            foreach ($items as $item) {
                $inventoryId = $item['inventory_id'];
                $quantity = max(0, (int)$item['quantity']);

                if ($existingItems->has($inventoryId)) {
                    $cartItem = $existingItems->get($inventoryId);
                    if ($quantity == 0) {
                        $cartItem->delete();
                    } else {
                        $cartItem->quantity = $quantity;
                        $cartItem->total_price = $quantity * $cartItem->price;
                        $cartItem->save();
                    }
                } else {
                    if ($quantity > 0) {
                        $inventory = Inventory::find($inventoryId);
                        if (!$inventory) {
                            continue;
                        }

                        CartItem::create([
                            'cart_id' => $cart->id,
                            'inventory_id' => $inventoryId,
                            'ip_address' => request()->ip(),
                            'uuid' => Str::uuid(),
                            'currency_code' => $cart->currency_code,
                            'quantity' => $quantity,
                            'price' => $inventory->sale_price ?? $inventory->offer_price,
                            'total_price' => $quantity * ($inventory->sale_price ?? $inventory->offer_price),
                            'status' => 1,
                        ]);
                    }
                }
            }

            $this->updateCartTotals($cart);
        });

        return response()->json([
            'cart' => $cart->load('items.inventory'),
        ])->cookie('cart_uuid', $cart->uuid, 60 * 24 * 30);
    }

    // Thêm sản phẩm đơn lẻ (nếu muốn)
    public function addItem(Request $request, CartService $cartService)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy cart_uuid từ body, header, hoặc cookie
        $cartUuid = $request->input('cart_uuid')?? $request->header('Cart-UUID')?? $request->cookie('cart_uuid');

        $cart = $cartService->getOrCreateCart(
            $request->user(),
            $cartUuid,
            $request->ip()
        );

        $result = $cartService->addOrUpdateItem(
            $cart,
            $request->input('inventory_id'),
            $request->input('quantity')
        );

        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], 422);
        }

        $response = response()->json($result);

        if (!$request->user()) {
            $response->cookie('cart_uuid', $cart->uuid, 60 * 24 * 30); // 30 ngày
        }

        return $response;
    }


    // Cập nhật số lượng nhiều item
    public function update(Request $request, $cartId)
    {
        $cart = Cart::findOrFail($cartId);
        if ($cart->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized: You do not own this cart'], 403);
        }

        $request->validate([
            'items' => 'required|array',
            'items.*.inventory_id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        $cart = Cart::findOrFail($cartId);

        DB::transaction(function () use ($request, $cart) {
            foreach ($request->input('items') as $item) {
                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('inventory_id', $item['inventory_id'])
                    ->first();

                if (!$cartItem) continue;

                if ($item['quantity'] == 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->quantity = $item['quantity'];
                    $cartItem->total_price = $cartItem->quantity * $cartItem->price;
                    $cartItem->save();
                }
            }

            $this->updateCartTotals($cart);
        });

        return response()->json(['cart' => $cart->load('items.inventory')]);
    }

    public function removeItemForUser(Request $request, CartService $cartService, $cartId, $inventoryId)
    {
        $cart = Cart::where('id', $cartId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $updatedCart = $cartService->removeItem($cart, $inventoryId);

        return response()->json(['cart' => $updatedCart]);
    }

    // Xóa item trong giỏ hàng guest (dùng cart_uuid)
    public function removeItemForGuest(Request $request, CartService $cartService, $cartUuid, $inventoryId)
    {
        $cart = Cart::where('uuid', $cartUuid)->firstOrFail();

        $updatedCart = $cartService->removeItem($cart, $inventoryId);

        return response()->json(['cart' => $updatedCart]);
    }

    public function destroy(Request $request, CartService $cartService)
    {
        $cartUuid = $request->input('cart_uuid')
            ?? $request->header('Cart-UUID')
            ?? $request->cookie('cart_uuid');

        $cart = Cart::where('uuid', $cartUuid)
            ->orWhere('user_id', optional($request->user())->id)
            ->firstOrFail();

        $cartService->clearCart($cart);

        return response()->json(['message' => 'Cart deleted successfully']);
    }


    // Cập nhật tổng số lượng, giá tiền
    protected function updateCartTotals(Cart $cart)
    {
        $totalQuantity = $cart->items()->sum('quantity');
        $totalItem = $cart->items()->count();
        $totalPrice = $cart->items()->sum('total_price');

        $cart->total_quantity = $totalQuantity;
        $cart->total_item = $totalItem;
        $cart->total_price = $totalPrice;
        $cart->save();
    }

    public function updateGuestCart(Request $request, $cartUuid)
    {
        $items = $request->input('items');

        if (!$items || !is_array($items)) {
            return response()->json(['message' => 'Invalid cart items'], 400);
        }

        $cart = Cart::where('uuid', $cartUuid)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $existingItems = $cart->items()->get()->keyBy('inventory_id');

        DB::transaction(function () use ($cart, $items, $existingItems) {
            foreach ($items as $item) {
                $inventoryId = $item['inventory_id'];
                $quantity = max(0, (int)$item['quantity']);

                if ($existingItems->has($inventoryId)) {
                    $cartItem = $existingItems->get($inventoryId);
                    if ($quantity == 0) {
                        $cartItem->delete();
                    } else {
                        $cartItem->quantity = $quantity;
                        $cartItem->total_price = $quantity * $cartItem->price;
                        $cartItem->save();
                    }
                } else {
                    if ($quantity > 0) {
                        $inventory = Inventory::find($inventoryId);
                        if (!$inventory) {
                            continue;
                        }

                        CartItem::create([
                            'cart_id' => $cart->id,
                            'inventory_id' => $inventoryId,
                            'ip_address' => request()->ip(),
                            'uuid' => Str::uuid(),
                            'currency_code' => $cart->currency_code,
                            'quantity' => $quantity,
                            'price' => $inventory->sale_price ?? $inventory->offer_price,
                            'total_price' => $quantity * ($inventory->sale_price ?? $inventory->offer_price),
                            'status' => 1,
                        ]);
                    }
                }
            }

            // Cập nhật tổng số lượng, tổng giá giỏ hàng
            $this->updateCartTotals($cart);
        });

        return response()->json([
            'cart' => $cart->load('items.inventory'),
        ])->cookie('cart_uuid', $cart->uuid, 60 * 24 * 30);
    }

}
