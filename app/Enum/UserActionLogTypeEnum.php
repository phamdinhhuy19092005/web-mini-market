<?php

namespace App\Enum;

class UserActionLogTypeEnum extends BaseEnum
{
    public const ACTIVATE = 1;
    public const DEACTIVATE = 2;
    public const UPDATE = 3;
    public const DELETE = 4;

    public static function all(): array
    {
        return [
            self::ACTIVATE,
            self::DEACTIVATE,
            self::UPDATE,
            self::DELETE,
        ];
    }
}
