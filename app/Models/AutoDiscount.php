<?php

namespace App\Models;

use App\Enum\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Activatable;

class AutoDiscount extends Model
{
    use Activatable;

    protected $fillable = [
        'title',
        'code',
        'description',
        'condition_type',
        'condition_value',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'status',
    ];

    public function getDiscountTypeNameAttribute(): string
    {
        return DiscountTypeEnum::tryFrom($this->discount_type)?->label() ?? '';
    }

}
