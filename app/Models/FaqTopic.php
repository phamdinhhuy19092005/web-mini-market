<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class FaqTopic extends Model
{
    use Activatable;

    protected $fillable = [
        'name',
        'order',
        'status',
    ];

}
