<?php

namespace App\Enum;

class SubscriberTypeEnum extends BaseEnum
{
    public const NEWSLETTER = 1;

    public static function all(): array
    {
        return [
            self::NEWSLETTER,
        ];
    }

    public static function getName(int|string|null $value): string
    {
        return match ($value) {
            self::NEWSLETTER => __('Newsletter'),
            default => __('Không xác định'),
        };
    }
}
