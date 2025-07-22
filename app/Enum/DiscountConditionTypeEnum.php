<?php

namespace App\Enum;

enum DiscountConditionTypeEnum: string
{
    case MIN_TOTAL = 'min_total';
    case USER_FIRST_ORDER = 'user_first_order';
    case CATEGORY_ID = 'category_id';

    public function label(): string
    {
        return match ($this) {
            self::MIN_TOTAL => 'Đơn hàng tối thiểu',
            self::USER_FIRST_ORDER => 'Đơn hàng đầu tiên',
            self::CATEGORY_ID => 'Theo danh mục sản phẩm',
        };
    }

    public static function labels(): array
    {
        return array_map(
            fn($case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }

    public static function values(): array
    {
        return array_map(
            fn($case) => $case->value,
            self::cases()
        );
    }
}
