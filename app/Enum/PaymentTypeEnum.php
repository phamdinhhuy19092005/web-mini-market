<?php

namespace App\Enum;

enum PaymentTypeEnum: int
{
    case DEPOSIT = 1;

    public function label(): string
    {
        return match ($this) {
            self::DEPOSIT => 'Nạp tiền',
        };
    }

    public static function labels(): array
    {
        $result = [];
        foreach (self::cases() as $case) {
            $result[$case->value] = $case->label();
        }
        return $result;
    }
}
