<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'subscribers';

    protected $fillable = [
        'email',
        'type',
        'sent_post',
    ];

    protected $casts = [
        'sent_post' => 'json'
    ];

}

