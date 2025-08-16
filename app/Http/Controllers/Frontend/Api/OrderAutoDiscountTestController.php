<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDiscount;
use App\Models\UsedCoupon;
use Illuminate\Http\Request;

class OrderAutoDiscountTestController extends BaseController
{
    public function autoApply($orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return $this->jsonResponse(false, null, 'Đơn hàng không tồn tại', 404);
        }

        // Lấy coupon tự động hợp lệ
        $coupon = Coupon::where('is_auto_apply', true)
            ->where(function ($q) {
                $q->whereNull('usage_limit')
                  ->orWhere('usage_limit', '>', 0);
            })
            ->where(function ($q) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->first();

        if (!$coupon) {
            return $this->jsonResponse(false, null, 'Không có mã giảm giá tự động khả dụng', 404);
        }

        // Kiểm tra điều kiện đơn hàng
        if ($coupon->min_order_amount && $order->total < $coupon->min_order_amount) {
            return $this->jsonResponse(false, null, 'Đơn hàng không đủ điều kiện để áp mã tự động', 400);
        }

        // Áp dụng vào order_discounts
        OrderDiscount::create([
            'order_id' => $order->id,
            'discountable_id' => $coupon->id,
            'discountable_type' => Coupon::class,
            'discount_value' => $coupon->discount_value
        ]);

        // Ghi lại used_coupons
        UsedCoupon::create([
            'coupon_id' => $coupon->id,
            'user_id' => $order->user_id,
            'order_id' => $order->id,
        ]);

        // Trừ usage_limit
        if (!is_null($coupon->usage_limit)) {
            $coupon->decrement('usage_limit');
        }

        return $this->jsonResponse(true, [
            'order_id' => $order->id,
            'coupon_code' => $coupon->code,
            'discount_value' => $coupon->discount_value
        ], 'Áp dụng mã tự động thành công');
    }
}
