<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Category -> Model

class SubCategory extends Model
{
    use SoftDeletes;
    use Activatable;

    protected $table = 'sub_categories';
    protected $with = ['category.categoryGroup'];
    
    protected $fillable = [
        'name',
        'slug',
        'category_id', 
        'seo_title', 
        'description',
        'seo_description', 
        'image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_subcategories');   
    }

}

