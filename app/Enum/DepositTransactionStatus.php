<?php

namespace App\Enums;

enum DepositTransactionStatus: int
{
    case Pending = 0;
    case Completed = 1;
    case Cancelled = 2;

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Đang chờ',
            self::Completed => 'Đã hoàn tất',
            self::Cancelled => 'Đã huỷ',
        };
    }
}
