<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

// Category -> Model

class PostCategory extends Model
{
    use Activatable;
    
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

