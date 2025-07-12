<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'iso3',
        'numeric',
        'iso2',         
        'phonecode',
        'capital',
        'currency',
        'currency_name',
        'tld',
        'native',
        'region',
        'subregion',
        'timezones',
        'translations',
        'latitude',
        'longitude',
        'emoji',
        'emojiU',
        'status',
        'flag',
        'wikiDataId',
    ];

    protected $casts = [
        'timezones'    => 'array',
        'translations' => 'array',
        'status'       => 'boolean',
        'latitude'     => 'float',
        'longitude'    => 'float',
    ];
}
