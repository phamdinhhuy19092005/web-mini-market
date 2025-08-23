<?php

namespace App\Models;

use App\Enum\DepositStatusEnum;
use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Model;

class DepositTransaction extends Model
{
    use Activatable;

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

    public function getStatusNameAttribute(): string
    {
        return match ($this->status) {
            DepositStatusEnum::DECLINED => 'Từ chối',
            DepositStatusEnum::PENDING => 'Chờ xử lý',
            DepositStatusEnum::APPROVED => 'Đã duyệt',
            DepositStatusEnum::CANCELED => 'Hủy',
            DepositStatusEnum::FAILED => 'Thất bại',
            DepositStatusEnum::WAIT_FOR_CONFIRMATION => 'Chờ xác nhận',
            default => 'Không xác định',
        };
    }

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
