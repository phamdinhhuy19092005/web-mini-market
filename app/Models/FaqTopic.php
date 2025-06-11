<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory;

class FaqTopic extends Model
{
    protected $table = 'faq_topics';

    protected $fillable = [
        'name',
        'order',
        'status',
    ];

}
