<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDiscount;
use App\Models\UsedCoupon;
use Illuminate\Http\Request;

class OrderDiscountTestController extends BaseController
{
    public function applyCoupon(Request $request, $orderId)
    {   
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $order = Order::find($orderId);
        if (!$order) {
            return $this->jsonResponse(false, null, 'Đơn hàng không tồn tại', 404);
        }

        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return $this->jsonResponse(false, null, 'Mã giảm giá không tồn tại', 404);
        }

        // Check hết lượt
        if (!is_null($coupon->usage_limit) && $coupon->usage_limit <= 0) {
            return $this->jsonResponse(false, null, 'Mã giảm giá đã hết lượt sử dụng', 400);
        }

        // TODO: Thêm check thời hạn, điều kiện...
        $discountValue = $coupon->discount_value;

        // Lưu vào order_discounts
        OrderDiscount::create([
            'order_id' => $order->id,
            'discountable_id' => $coupon->id,
            'discountable_type' => Coupon::class,
            'discount_value' => $discountValue
        ]);

        // Lưu vào used_coupons
        UsedCoupon::create([
            'coupon_id' => $coupon->id,
            'user_id' => $order->user_id,
            'order_id' => $order->id,
        ]);

        // Giảm usage_limit
        if (!is_null($coupon->usage_limit)) {
            $coupon->decrement('usage_limit');
        }

        return $this->jsonResponse(true, [
            'order_id' => $order->id,
            'coupon_code' => $coupon->code,
            'discount_value' => $discountValue,
            'usage_limit_remaining' => $coupon->usage_limit
        ], 'Áp dụng mã giảm giá thành công');
    }

}
