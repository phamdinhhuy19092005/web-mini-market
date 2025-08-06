<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    protected $fillable = [
        'name',
        'type',
        'logo',
        'params',
        'shipping_provider_id',
        'expanded_content',
        'supported_countries',
        'supported_provinces',
        'order',
        'status',
        'display_on_frontend',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    // public function shippingProvider()
    // {
    //     return $this->belongsTo(shippingProvider::class);
    // }
}

