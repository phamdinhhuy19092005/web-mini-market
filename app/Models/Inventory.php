<?php

namespace App\Models;

use App\Models\Traits\Activatable;
use App\Models\Traits\HasImpactor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use SoftDeletes, Activatable;

    protected $table = 'inventories';

    protected $fillable = [
        'title',
        'product_id',
        'condition',
        'condition_note',
        'unit',
        'unit_price',
        'quantity_in_unit',
        'slug',
        'sku',
        'status',
        'key_features',
        'purchase_price',
        'sale_price',
        'offer_price',
        'weight',
        'offer_start',
        'offer_end',
        'init_sold_count',
        'stock_quantity',
        'min_order_quantity',
        'available_from',
        'meta_title',
        'meta_description',
        'image',
        'created_by_id',
        'created_by_type',
        'updated_by_id',
        'updated_by_type',
        'description',
    ];

    protected $casts = [
        'key_features' => 'array',
    ];

    public function setUnitPriceAttribute($value)
    {
        if ($value !== null) {
            $normalized = str_replace(['.', ','], '', $value);
            $this->attributes['unit_price'] = (int) $normalized;
        } else {
            $quantity = (float) ($this->quantity_in_unit ?? 1);
            $totalPrice = (float) ($this->offer_price ?? $this->sale_price ?? 0);

            $this->attributes['unit_price'] = $quantity > 0 ? round($totalPrice / $quantity) : (int) $totalPrice;
        }
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_inventories')
            ->withPivot('attribute_value_id')
            ->withTimestamps();
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_inventories')
            ->withPivot('attribute_id')
            ->with('attribute')
            ->withTimestamps();
    }

    public function attributeInventories(): HasMany
    {
        return $this->hasMany(AttributeInventory::class);
    }

    public function createdBy(): MorphTo
    {
        return $this->morphTo('created_by');
    }

    public function updatedBy(): MorphTo
    {
        return $this->morphTo('updated_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeDisplay($query)
    {
        return $query->where('is_displayed', true);
    }
}
