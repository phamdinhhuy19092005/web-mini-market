<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory;
use App\Models\Traits\Activatable;

class Post extends Model
{
    use Activatable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
        'image',
        'display_on_frontend',
        'meta_title',
        'meta_description',
        'status',
        'code',
        'author',
        'post_category_id',
        'content',
        'post_at',
    ];

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
