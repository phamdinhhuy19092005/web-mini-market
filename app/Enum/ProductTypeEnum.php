<?php

namespace App\Enum;

class ProductTypeEnum extends BaseEnum
{
    public const SIMPLE = 1;     
    public const VARIABLE = 2;   

    public static function all(): array
    {
        return [
            self::SIMPLE,
            self::VARIABLE,
        ];
    }

    public static function labels(): array
    {
        return [
            self::SIMPLE => 'Simple',
            self::VARIABLE => 'Variable',
        ];
    }

    public static function label(int|string|null $value): string
    {
        return self::labels()[$value] ?? '';
    }
}

