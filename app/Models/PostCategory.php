<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Category -> Model

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'order',
        'display_on_frontend',
        'description',
        'meta_title',
        'meta_description',
        'status',
        'category_group_id',
    ];

}

