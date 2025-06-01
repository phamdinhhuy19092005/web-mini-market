<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// CategoryGroup -> Model

class CategoryGroup extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'description', 'seo_title', 'seo_description', 'status', 'created_at', 'updated_at'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
