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
            self::INACTIVE => 'Không hoạt động',
            self::ACTIVE => 'Hoạt động',
        ];
    }

    public static function label($value): string
    {
        if ($value instanceof self) {
            $value = $value->value ?? null;
        } elseif (!is_scalar($value)) {
            return 'Unknown';
        }

        return self::labels()[(int)$value] ?? 'Unknown';
    }



}
