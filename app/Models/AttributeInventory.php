<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeInventory extends Model
{
    protected $table = 'attribute_inventories';

    protected $fillable = [
        'attribute_id',
        'inventory_id',
        'attribute_value_id',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
