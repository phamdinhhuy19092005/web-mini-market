<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsedDiscount extends Model
{
    protected $fillable = [
        'coupon_id',
        'order_id',
        'user_id',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
