<?php

namespace App\Enum;

class CurrencyTypeEnum extends BaseEnum
{
    public const FIAT = 1;
    public const CRYPTO = 2;

    public static $labels = [
        self::FIAT => 'Fiat Money',
        self::CRYPTO => 'Cryptocurrency',
    ];

    public static function all(): array
    {
        return array_keys(self::$labels);
    }

    public static function getName(int|string|null $value): string
    {
        return self::$labels[$value] ?? 'Unknown';
    }
}
