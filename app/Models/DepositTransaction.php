<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_option_id',
        'amount',
        'bank_account',
        'transfer_content',
        'transaction_code',
        'status',
        'note',
        'created_by_id',
        'created_by_type',
        'updated_by_id',
        'updated_by_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->morphTo(__FUNCTION__, 'created_by_type', 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->morphTo(__FUNCTION__, 'updated_by_type', 'updated_by_id');
    }
}
