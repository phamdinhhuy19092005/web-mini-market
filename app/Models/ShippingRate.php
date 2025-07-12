<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    protected $table = 'shipping_rates';

    protected $fillable = [
        'name',
        'shipping_zone_id',
        'carrier_id',
        'delivery_takes',
        'type',
        'minimum',
        'maximum',
        'rate',
        'status',
        'display_on_frontend',
    ];

    public function shippingZone()
    {
        return $this->belongsTo(ShippingZone::class);
    }

}

