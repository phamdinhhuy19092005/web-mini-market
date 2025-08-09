<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $uuid = $this->getCartUuid($request);

        if ($user) {
            $cart = Cart::with('items.inventory')
                ->where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->first();

            if (!$cart && $uuid) {
                $guestCart = Cart::where('uuid', $uuid)->whereNull('user_id')->first();
                if ($guestCart) {
                    $cart = Cart::firstOrCreate(
                        ['user_id' => $user->id],
                        [
                            'ip_address' => $request->ip(),
                            'currency_code' => $guestCart->currency_code ?? 'VND',
                            'uuid' => (string) Str::uuid(),
                        ]
                    );

                    foreach ($guestCart->items as $item) {
                        $existing = $cart->items()->where('inventory_id', $item->inventory_id)->first();
                        if ($existing) {
                            $existing->quantity += $item->quantity;
                            $existing->total_price = $existing->price * $existing->quantity;
                            $existing->save();
                        } else {
                            $cart->items()->create($item->toArray());
                        }
                    }
                    $guestCart->delete();
                    $cart->updateTotals();
                }
            }

            if ($cart) {
                $cart->updateTotals();
            }

            return response()->json($cart ?? [])->withoutCookie('cart_uuid');
        } elseif ($uuid) {
            $cart = Cart::with('items.inventory')->where('uuid', $uuid)->first();
            if ($cart) {
                $cart->updateTotals();
            }
            return response()->json($cart ?? [])->withCookie(cookie('cart_uuid', $uuid, 43200));
        }

        return response()->json([]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->cookie('cart_uuid') ?? (string) Str::uuid();

        if ($user && $uuid) {
            $guestCart = Cart::where('uuid', $uuid)->first();
            $userCart = Cart::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'ip_address' => $request->ip(),
                    'currency_code' => $request->currency_code ?? 'VND',
                    'uuid' => (string) Str::uuid(),
                ]
            );

            if ($guestCart && $guestCart->id !== $userCart->id) {
                foreach ($guestCart->items as $item) {
                    $existing = $userCart->items()->where('inventory_id', $item->inventory_id)->first();
                    if ($existing) {
                        $existing->quantity += $item->quantity;
                        $existing->total_price = $existing->price * $existing->quantity;
                        $existing->save();
                    } else {
                        $userCart->items()->create([
                            'inventory_id' => $item->inventory_id,
                            'quantity' => $item->quantity,
                            'uuid' => (string) Str::uuid(),
                            'currency_code' => $item->currency_code,
                            'status' => $item->status,
                            'price' => $item->price,
                            'total_price' => $item->total_price,
                            'has_combo' => $item->has_combo,
                        ]);
                    }
                }
                $guestCart->delete();
                $userCart->updateTotals(); // Cập nhật tổng số lượng và giá
            }

            if ($userCart->user_id !== $user->id) {
                $userCart->user_id = $user->id;
                $userCart->save();
            }

            return response()->json($userCart)->withoutCookie('cart_uuid');
        }

        $cart = Cart::firstOrCreate(
            ['uuid' => $uuid],
            [
                'ip_address' => $request->ip(),
                'currency_code' => $request->currency_code ?? 'VND',
                'user_id' => null,
                'uuid' => $uuid,
            ]
        );
        $cart->updateTotals(); // Cập nhật tổng số lượng và giá

        return response()->json($cart)->withCookie(cookie('cart_uuid', $uuid, 43200));
    }
    

    public function addItem(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $inventory = Inventory::find($request->inventory_id);
        $price = $inventory ? ($inventory->offer_price ?? $inventory->sale_price ?? 0) : 0;
        $totalPrice = $price * $request->quantity;
        $uuid = $request->cookie('cart_uuid') ?? (string) Str::uuid();

        if ($user) {
            $userCart = Cart::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'ip_address' => $request->ip(),
                    'currency_code' => $request->currency_code ?? 'VND',
                    'uuid' => (string) Str::uuid(),
                ]
            );

            $guestCart = Cart::where('uuid', $uuid)->whereNull('user_id')->first();

            if ($guestCart && $guestCart->id !== $userCart->id) {
                foreach ($guestCart->items as $item) {
                    $existing = $userCart->items()->where('inventory_id', $item->inventory_id)->first();
                    if ($existing) {
                        $existing->quantity += $item->quantity;
                        $existing->total_price = $existing->price * $existing->quantity;
                        $existing->save();
                    } else {
                        $userCart->items()->create([
                            'inventory_id' => $item->inventory_id,
                            'quantity' => $item->quantity,
                            'uuid' => (string) Str::uuid(),
                            'currency_code' => $item->currency_code,
                            'status' => $item->status,
                            'price' => $item->price,
                            'total_price' => $item->total_price,
                            'has_combo' => $item->has_combo,
                        ]);
                    }
                }
                $guestCart->delete();
            }

            $existingItem = $userCart->items()->where('inventory_id', $request->inventory_id)->first();
            if ($existingItem) {
                $existingItem->quantity += $request->quantity;
                $existingItem->total_price = $existingItem->price * $existingItem->quantity;
                $existingItem->save();
                $item = $existingItem;
            } else {
                $item = $userCart->items()->create([
                    'inventory_id' => $request->inventory_id,
                    'quantity' => $request->quantity,
                    'uuid' => (string) Str::uuid(),
                    'currency_code' => $request->currency_code ?? 'VND',
                    'status' => 1,
                    'price' => $price,
                    'total_price' => $totalPrice,
                    'has_combo' => 0,
                ]);
            }

            $userCart->updateTotals(); // Cập nhật tổng số lượng và giá

            return response()->json($item)->withoutCookie('cart_uuid');
        } else {
            $cart = Cart::firstOrCreate(
                ['uuid' => $uuid],
                [
                    'ip_address' => $request->ip(),
                    'currency_code' => $request->currency_code ?? 'VND',
                    'user_id' => null,
                ]
            );

            $existingItem = $cart->items()->where('inventory_id', $request->inventory_id)->first();
            if ($existingItem) {
                $existingItem->quantity += $request->quantity;
                $existingItem->total_price = $existingItem->price * $existingItem->quantity;
                $existingItem->save();
                $item = $existingItem;
            } else {
                $item = $cart->items()->create([
                    'inventory_id' => $request->inventory_id,
                    'quantity' => $request->quantity,
                    'uuid' => (string) Str::uuid(),
                    'currency_code' => $request->currency_code ?? 'VND',
                    'status' => 1,
                    'price' => $price,
                    'total_price' => $totalPrice,
                    'has_combo' => 0,
                ]);
            }

            $cart->updateTotals(); // Cập nhật tổng số lượng và giá

            return response()->json($item)->withCookie(cookie('cart_uuid', $uuid, 43200));
        }
    }

    public function show($id)
    {
        $cart = Cart::with('items.inventory')->find($id);

        if (!$cart) {
            return response()->json(['message' => 'Giỏ hàng không tìm thấy'], 404);
        }

        return response()->json($cart);
    }

}
