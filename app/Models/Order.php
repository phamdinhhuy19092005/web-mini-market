<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'uuid',
        'user_id',
        'currency_code',
        'fullname',
        'email',
        'phone',
        'country_code',
        'address_line',
    ];

    public function usedCoupons()
    {
        return $this->hasMany(UsedCoupon::class);
    }
}
