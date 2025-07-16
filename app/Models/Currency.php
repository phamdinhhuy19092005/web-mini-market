<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'type',
        'name',
        'code',
        'symbol',
        'decimals',
        'status',
        'used_countries',
    ];

    protected $casts = [
        'used_countries' => 'array',
        // 'status' => 'boolean',
    ];
}
