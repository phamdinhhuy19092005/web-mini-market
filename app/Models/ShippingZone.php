<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    protected $table = 'shipping_zones';

    protected $fillable = [
       'name',
       'supported_countries',
       'status',
       'supported_provinces',
       'supported_districts',
    ];

    protected $casts = [
        'supported_countries' => 'array',
        'supported_provinces' => 'array',
        'supported_districts' => 'array',
    ];

}
