<?php

namespace App\Enum;

enum DiscountTypeEnum: int
{
    case PERCENTAGE = 1;
    case FIXED = 2;

    public function label(): string
    {
        return match ($this) {
            self::PERCENTAGE => 'Giảm theo phần trăm',
            self::FIXED => 'Giảm cố định',
        };
    }

    public static function labels(): array
    {
        return array_map(
            fn($case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }

    public static function values(): array
    {
        return array_map(
            fn($case) => $case->value,
            self::cases()
        );
    }
}
