<?php

namespace App\Enum;

class CartItemStatusEnum extends BaseEnum
{
    public const CANCELED = 0;
    public const PENDING  = 1;
    public const APPROVED = 3;

    public static function all(): array
    {
        return [
            self::CANCELED,
            self::PENDING,
            self::APPROVED,
        ];
    }

    public static function labels(): array
    {
        return [
            self::CANCELED => 'Đã hủy',
            self::PENDING  => 'Chờ xử lý',
            self::APPROVED => 'Đã xác nhận',
        ];
    }

    public static function label(int $value): string
    {
        return self::labels()[$value] ?? 'Không xác định';
    }
}
