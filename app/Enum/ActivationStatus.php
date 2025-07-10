<?php

namespace App\Enum;

class ActivationStatus extends BaseEnum
{
    public const INACTIVE = 0;
    public const ACTIVE = 1;

    public static function all(): array
    {
        return [
            self::INACTIVE,
            self::ACTIVE,
        ];
    }

    public static function labels(): array
    {
        return [
            self::INACTIVE => 'Inactive',
            self::ACTIVE => 'Active',
        ];
    }

    public static function label($value): string
    {
        return self::labels()[$value] ?? 'Unknown';
    }

}
