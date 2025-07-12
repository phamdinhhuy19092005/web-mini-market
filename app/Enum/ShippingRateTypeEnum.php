<?php

namespace App\Enum;

class ShippingRateTypeEnum extends BaseEnum
{
    public const PRICE = 1;
    public const WEIGHT = 2;

    public static function all(): array
    {
        return [
            self::PRICE,
            self::WEIGHT,
        ];
    }

    public static function labels(): array
    {
        return [
            self::PRICE => __('Price'),
            self::WEIGHT => __('Weight'),
        ];
    }

    public static function getName(int|string|null $value): string
    {
        return self::labels()[$value] ?? __('Unknown');
    }
}
