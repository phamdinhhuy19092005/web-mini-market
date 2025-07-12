<?php

namespace App\Enum;

class ProductAttributeTypeEnum extends BaseEnum
{
    public const SELECT = 1;
    public const RADIO = 2;
    public const NUMBER = 3;
    public const TEXT = 4;
    public const DATE = 5;

    public static $labels = [
        self::SELECT => 'Select',
        self::RADIO => 'Radio',
        self::NUMBER => 'Number',
        self::TEXT => 'Text',
        self::DATE => 'Date',
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
