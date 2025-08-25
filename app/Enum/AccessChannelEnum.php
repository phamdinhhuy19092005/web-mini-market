<?php

namespace App\Enum;

enum AccessChannelEnum: int
{
    case GOOGLE = 1;
    case FORM = 2;

    public function label(): string
    {
        return match ($this) {
            self::GOOGLE => 'Google',
            self::FORM => 'Form',
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
