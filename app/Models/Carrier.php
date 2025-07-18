<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $table = 'carriers';

    protected $fillable = [
        'name',
        'logo',
        'code',
        'description',
        'status',
    ];
}
