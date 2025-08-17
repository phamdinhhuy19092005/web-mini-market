<?php

namespace App\Enum;

class AccessChannelOptions extends BaseEnum
{
    public const WEBSITE = 1;
    public const SHOPEE = 2;
    public const LAZADA = 3;
    public const TIKI = 4;
    public const FACEBOOK = 5;
    public const TIKTOK = 6;
    public const INSTAGRAM = 7;

    public static function all(): array
    {
        return [
            self::WEBSITE,
            self::SHOPEE,
            self::LAZADA,
            self::TIKI,
            self::FACEBOOK,
            self::TIKTOK,
            self::INSTAGRAM
        ];
    }

    public static function labels(): array
    {
        return [
            self::WEBSITE   => 'Website',
            self::SHOPEE    => 'Shopee',
            self::LAZADA    => 'Lazada',
            self::TIKI      => 'Tiki',
            self::FACEBOOK  => 'Facebook',
            self::TIKTOK    => 'TikTok',
            self::INSTAGRAM => 'Instagram',
        ];
    }

    public static function label(int|string|null $value): string
    {
        return self::labels()[$value] ?? 'Không xác định 1';
    }
}
