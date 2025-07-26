<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\DepositTransactionStatus;

class DepositTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'payment_option_id',
        'amount',
        'bank_account',
        'transfer_content',
        'transaction_code',
        'status',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

