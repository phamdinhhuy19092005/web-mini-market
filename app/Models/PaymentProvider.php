<?php

namespace App\Models;

use App\Enum\PaymentTypeEnum;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class PaymentProvider extends Model
{
    use Activatable;

    protected $fillable = [
        'name',
        'code',
        'params',
        'payment_type',
        'status',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    public function paymentOptions()
    {
        return $this->hasMany(PaymentOption::class, 'payment_provider_id');
    }

    public function isActive(): bool
    {
        return $this->status === 1;
    }

     public function isDeposit(): bool
    {
        return $this->payment_type === PaymentTypeEnum::DEPOSIT;
    }

    public function getTypeNameAttribute(): string
    {
        return PaymentTypeEnum::from($this->payment_type)->label();
    }
}
