<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use Illuminate\Database\Eloquent\Model;

// Category -> Model

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = [
        'name', 'slug', 'category_id', 'seo_title', 'seo_description', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_subcategories');   
    }

    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }

}

