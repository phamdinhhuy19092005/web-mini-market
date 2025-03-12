<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Category -> Model

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'seo_title',
        'seo_description',
        'status',
        'category_group_id',
    ];

    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }
}

