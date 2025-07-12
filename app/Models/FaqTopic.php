<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTopic extends Model
{
    protected $table = 'faq_topics';

    protected $fillable = [
        'name',
        'order',
        'status',
    ];

}
