<?php

namespace App\Enum;

class ShippingOptionTypeEnum extends BaseEnum
{
    public const NONE_AMOUNT       = 1;
    public const SHIPPING_PROVIDER = 2;
    public const SHIPPING_ZONE     = 3;

    public static function all(): array
    {
        return [
            self::NONE_AMOUNT,
            self::SHIPPING_PROVIDER,
            self::SHIPPING_ZONE,
        ];
    }

    public static function labels(): array
    {
        return [
            self::NONE_AMOUNT       => 'Không tính phí',
            self::SHIPPING_PROVIDER => 'Đối tác vận chuyển',
            self::SHIPPING_ZONE     => 'Theo khu vực',
        ];
    }

    public static function label(int $key): string
    {
        return self::labels()[$key] ?? 'Không xác định';
    }

    public static function isThirdParty($key): bool
    {
        return $key == self::SHIPPING_PROVIDER;
    }

    public static function isShippingZone($key): bool
    {
        return $key == self::SHIPPING_ZONE;
    }

    public static function isNoneAmount($key): bool
    {
        return $key == self::NONE_AMOUNT;
    }
}
