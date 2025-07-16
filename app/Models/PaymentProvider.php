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
        return $this->hasMany(PaymentOption::class);
    }

    public function getTypeNameAttribute(): string
    {
        return PaymentTypeEnum::from($this->payment_type)->label();
    }
}
