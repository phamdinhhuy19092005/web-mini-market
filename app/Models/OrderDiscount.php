<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'discountable_id',
        'discountable_type',
        'discount_value',
    ];


    /**
     * Liên kết tới đơn hàng
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Liên kết polymorphic tới mã giảm giá (Coupon hoặc AutoDiscount)
     */
    public function discountable()
    {
        return $this->morphTo();
    }
}
