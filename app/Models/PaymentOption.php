<?php

namespace App\Models;

use App\Enum\ActivationStatusEnum;
use App\Enum\PaymentOptionTypeEnum;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentOption extends Model
{
    use Activatable;

    protected $fillable = [
        'name',
        'type',
        'min_amount',
        'max_amount',
        'currency_code',
        'logo',
        'status',
        'online_banking_code',
        'payment_provider_id',
        'params',
        'display_on_frontend',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    public function paymentProvider()
    {
        return $this->belongsTo(PaymentProvider::class);
    }

    // public function getTypeNameAttribute(): string
    // {
    //     return $this->type
    //         ? PaymentOptionTypeEnum::from($this->type)->label()
    //         : '';
    // }

}
