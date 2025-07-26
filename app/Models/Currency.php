<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use Activatable;

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
    ];
}
