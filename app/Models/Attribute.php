<?php

namespace App\Models;

use App\Enum\ActivationStatus;
use App\Enum\ProductAttributeTypeEnum;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Activatable;
    
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

}
