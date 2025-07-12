<?php

namespace App\Enum;

enum UserActionEnum: int
{
    case ACTIVE = 1;
    case DEACTIVATE = 2;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'ACTIVE',
            self::DEACTIVATE => 'DEACTIVATE',
        };
    }

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function types(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }
}
