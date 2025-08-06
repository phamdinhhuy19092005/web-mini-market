<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory;
use App\Models\Traits\Activatable;

class Page extends Model
{
    use Activatable;

    protected $fillable = [
        'name',
        'slug',
        'custom_redirect_url',
        'title',
        'order',
        'display_on_frontend',
        'meta_title',
        'meta_description',
        'status',
        'code', 
        'author',
        'content',
        'post_at', 
        'display_in',
        'created_by_id',
        'created_by_type',
        'updated_by_id',
        'updated_by_type',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'display_in' => 'array',
    ];
}
