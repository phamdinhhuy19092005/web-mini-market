<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
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

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
