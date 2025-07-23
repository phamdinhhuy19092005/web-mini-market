<?php

namespace App\Enum;

enum ReviewStatusEnum: int
{
    case DECLINED = 0;
    case PENDING = 1;
    case APPROVED = 2;

    public function label(): string
    {
        return match ($this) {
            self::DECLINED => 'Declined',
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
        };
    }

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
