<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Category -> Model

class Category extends Model
{
    use SoftDeletes;
    use Activatable;

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
}

