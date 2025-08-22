<?php

namespace App\Enum;

class PaymentOptionTypeEnum extends BaseEnum
{
    public const PAYMENT_PROVIDER = 2;
    public const COD = 3;

    public static function all(): array
    {
        return [
            self::PAYMENT_PROVIDER,
            self::COD
        ];
    }

    public static function isThirdParty($key)
    {
        return $key == self::PAYMENT_PROVIDER;
    }

    public static function isNoneAmount($key)
    {
        return $key == self::COD;
    }

    public static function labels(): array
    {
        return [
            self::PAYMENT_PROVIDER => 'Cổng thanh toán',
            self::COD => 'COD',
        ];
    }
}
