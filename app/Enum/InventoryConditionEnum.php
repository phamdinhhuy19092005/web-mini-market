<?php

namespace App\Enum;

class InventoryConditionEnum extends BaseEnum
{
    public const NEW = 1;
    public const NEAR_EXPIRY = 2;
    public const DAMAGED_PACKAGING = 3;
    public const EXPIRED = 4;
    public const RETURNED = 5;
    public const PROMOTION = 6;

    protected static array $labels = [
        self::NEW => 'Hàng mới',
        self::NEAR_EXPIRY => 'Gần hết hạn',
        self::DAMAGED_PACKAGING => 'Bao bì hỏng nhẹ',
        self::EXPIRED => 'Hết hạn',
        self::RETURNED => 'Hàng trả lại',
        self::PROMOTION => 'Hàng khuyến mãi',
    ];

    public static function all(): array
    {
        return array_keys(static::$labels);
    }

    public static function labels(): array
    {
        return static::$labels;
    }

    public static function label(int|string $value): string
    {
        return static::$labels[$value] ?? 'Unknown';
    }
}
