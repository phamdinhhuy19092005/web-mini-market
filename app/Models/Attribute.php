<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use App\Enum\ProductAttributeTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
        'attribute_type',
        'order',
        'status',
    ];

     public function categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_categories');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function getAttributeTypeNameAttribute(): string
    {
        return ProductAttributeTypeEnum::label($this->attribute_type);
    }

    public function getStatusNameAttribute(): string
    {
        return ActivationStatus::label($this->status);
    }
}
