<?php

namespace App\Enum;

enum AccessChannelEnum: int
{
    case GOOGLE = 1;
    case SMS = 2;

    public function label(): string
    {
        return match ($this) {
            self::GOOGLE => 'Google',
            self::SMS => 'SMS',
        };
    }

    public static function labels(): array
    {
        $labels = [];
        foreach (self::cases() as $case) {
            $labels[$case->value] = $case->label();
        }
        return $labels;
    }
}
