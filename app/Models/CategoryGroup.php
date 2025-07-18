<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// CategoryGroup -> Model

class CategoryGroup extends Model
{
    use SoftDeletes, Activatable;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'seo_title',
        'seo_description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
