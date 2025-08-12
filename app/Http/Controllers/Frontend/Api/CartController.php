<?php

namespace App\Http\Controllers\Frontend\Api;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Inventory;
use Illuminate\Support\Str;

class CartController extends BaseApiController
{
    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|integer|exists:inventories,id',
            'quantity'     => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            [
                'uuid'          => Str::uuid(),
                'currency_code' => 'VND',
                'ip_address'    => $request->ip(),
            ]
        );

        $inventory = Inventory::findOrFail($request->inventory_id);
        $price = $inventory->sale_price ?? $inventory->offer_price ?? $inventory->price;

        $item = $cart->items()->where('inventory_id', $inventory->id)->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->price = $price;
            $item->total_price = $price * $item->quantity;
            $item->save();
        } else {
            $cart->items()->create([
                'uuid'          => Str::uuid(),
                'inventory_id'  => $inventory->id,
                'currency_code' => $cart->currency_code,
                'quantity'      => $request->quantity,
                'price'         => $price,
                'total_price'   => $price * $request->quantity,
                'status'        => 1,
            ]);
        }

        $cart->updateTotals();

        return response()->json([
            'message' => 'Item added to cart successfully',
            'cart'    => $cart->load('items'),
        ]);
    }

    /**
     * Cập nhật số lượng sản phẩm
     */
    public function updateItem(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update([
            'quantity'    => $request->quantity,
            'total_price' => $item->price * $request->quantity,
        ]);

        $item->cart->updateTotals();

        return response()->json([
            'message' => 'Item updated successfully',
            'item'    => $item,
        ]);
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function removeItem(CartItem $item)
    {
        $cart = $item->cart;
        $item->delete();
        $cart->updateTotals();

        return response()->json([
            'message' => 'Item removed from cart successfully',
        ]);
    }

    /**
     * Xóa toàn bộ giỏ hàng
     */
    public function clearCart(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->first();

        if ($cart) {
            $cart->items()->delete();
            $cart->updateTotals();
        }

        return response()->json([
            'message' => 'Cart cleared successfully',
        ]);
    }

    /**
     * Đồng bộ giỏ hàng (merge khi đăng nhập)
     */
    public function syncCart(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.inventory_id' => 'required|integer|exists:inventories,id',
            'items.*.quantity'     => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            [
                'uuid'          => Str::uuid(),
                'currency_code' => 'VND',
                'ip_address'    => $request->ip(),
            ]
        );

        foreach ($request->items as $item) {
            $inventory = Inventory::findOrFail($item['inventory_id']);
            $price = $inventory->sale_price ?? $inventory->offer_price ?? $inventory->price;

            $existingItem = $cart->items()->where('inventory_id', $inventory->id)->first();

            if ($existingItem) {
                $existingItem->quantity += $item['quantity'];
                $existingItem->price = $price;
                $existingItem->total_price = $price * $existingItem->quantity;
                $existingItem->save();
            } else {
                $cart->items()->create([
                    'uuid'          => Str::uuid(),
                    'inventory_id'  => $inventory->id,
                    'quantity'      => $item['quantity'],
                    'currency_code' => $cart->currency_code,
                    'price'         => $price,
                    'total_price'   => $price * $item['quantity'],
                    'status'        => 1,
                ]);
            }
        }
        $cart->updateTotals();

        return response()->json([
            'message' => 'Cart merged successfully',
            'cart'    => $cart->load('items'),
        ]);
    }
}
