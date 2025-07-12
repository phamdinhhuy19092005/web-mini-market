<?php

namespace App\Enum;

class BannerTypeEnum extends BaseEnum
{
    public const HOMEPAGE = 1;
    public const PRODUCT_PAGE = 2;
    public const PROMOTION = 3;

    public static function all(): array
    {
        return [
            self::HOMEPAGE,
            self::PRODUCT_PAGE,
            self::PROMOTION,
        ];
    }

    public static function getName(int|string|null $value): string
    {
        return match ($value) {
            self::HOMEPAGE => __('Trang chủ'),
            self::PRODUCT_PAGE => __('Trang sản phẩm'),
            self::PROMOTION => __('Khuyến mãi'),
            default => __('Không xác định'),
        };
    }
}
