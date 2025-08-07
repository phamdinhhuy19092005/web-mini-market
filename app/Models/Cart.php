<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use Activatable;

    protected $fillable = [
        'uuid',
        'ip_address',
        'user_id',
        'currency_code',
        'address_id',
        'total_item',
        'total_quantity',
        'total_price',
        'order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
