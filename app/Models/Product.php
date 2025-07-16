<?php

namespace App\Models;

use App\Enum\ProductTypeEnum;
use App\Models\Traits\Activatable;
use App\Models\Traits\HasImpactor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasImpactor;
    use Activatable;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'brand_id',
        'description',
        'status',
        'type',
        'primary_image',
        'media',
        'suggested_relationships',
        'created_by_type',
        'created_by_id',
        'updated_by_type',
        'updated_by_id',
    ];

    protected $casts = [
        'media' => 'array',
        'suggested_relationships' => 'array',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    public function subcategories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'product_subcategories', 'product_id', 'subcategory_id');
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }

    public function getTypeNameAttribute(): string
    {
        return ProductTypeEnum::label($this->type);
    }
}
