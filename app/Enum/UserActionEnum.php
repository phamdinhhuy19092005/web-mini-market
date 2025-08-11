<?php

namespace App\Enum;

enum UserActionEnum: int
{
    case PENDING = 0;      // chưa kích hoạt
    case ACTIVE = 1;       // đã kích hoạt
    case DEACTIVATE = 2;   // bị khóa/deactive

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'PENDING',
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
