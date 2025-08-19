<?php

namespace App\Models;

use App\Enum\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Activatable;

class Coupon extends Model
{
    use Activatable;

    protected $fillable = [
        'title',
        'code',
        'discount_type',
        'discount_value',
        'usage_limit',
        'terms',
        'used',
        'start_date',
        'end_date',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function usedDiscounts()
    {
        return $this->hasMany(UsedDiscount::class);
    }

    public function getUsedCountAttribute()
    {
        return $this->usedDiscounts()->count();
    }

    public function getDiscountTypeNameAttribute(): string
    {
        $type = DiscountTypeEnum::tryFrom($this->discount_type);
        return $type ? $type->label() : '';
    }
}
