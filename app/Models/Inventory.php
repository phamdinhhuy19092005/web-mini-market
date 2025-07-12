<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use SoftDeletes;

    protected $table = 'inventories';

    protected $fillable = [
        'title',
        'product_id',
        'condition',
        'condition_note',
        'slug',
        'sku',
        'status',
        'key_features',
        'purchase_price',
        'sale_price',
        'offer_price',
        'offer_start',
        'offer_end',
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
    ];

    protected $casts = [
        'key_features'      => 'array',
        'purchase_price'    => 'decimal:8',
        'sale_price'        => 'decimal:8',
        'offer_price'       => 'decimal:8',
        'offer_start'       => 'datetime',
        'offer_end'         => 'datetime',
        'available_from'    => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_inventories')
                    ->withPivot('attribute_value_id') 
                    ->withTimestamps();
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_inventories')
                    ->withPivot('attribute_id')
                    ->withTimestamps();
    }

    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }

    public function createdBy(): MorphTo
    {
        return $this->morphTo('created_by');
    }
    
    public function updatedBy(): MorphTo
    {
        return $this->morphTo('updated_by');
    }
}
