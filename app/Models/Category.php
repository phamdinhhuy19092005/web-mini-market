<?php

namespace App\Models;

use App\Enum\ActivationStatus;
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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_categories');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    
    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }

}

