<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->cookie('cart_uuid');

        $cart = Cart::with('items.inventory')
            ->when($user, fn($q) => $q->where('user_id', $user->id))
            ->when(!$user && $uuid, fn($q) => $q->where('uuid', $uuid))
            ->first();

        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->cookie('cart_uuid') ?? (string) Str::uuid();

        $cart = Cart::firstOrCreate(
            [
                $user ? 'user_id' : 'uuid' => $user ? $user->id : $uuid,
            ],
            [
                'ip_address' => $request->ip(),
                'currency_code' => $request->currency_code ?? 'VND',
            ]
        );

        $cookie = !$user ? cookie('cart_uuid', $uuid, 43200) : null;

        return response()->json($cart)->withCookie($cookie);
    }

    public function addItem(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->cookie('cart_uuid');

        $cart = Cart::firstOrCreate(
            [
                $user ? 'user_id' : 'uuid' => $user ? $user->id : $uuid,
            ],
            [
                'ip_address' => $request->ip(),
                'currency_code' => $request->currency_code ?? 'VND',
            ]
        );

        $item = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'inventory_id' => $request->inventory_id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        $cookie = !$user ? cookie('cart_uuid', $uuid, 43200) : null;

        return response()->json($item)->withCookie($cookie);
    }
}
