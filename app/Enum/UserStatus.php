<?php

namespace App\Enum;

use App\Traits\EnumOptions;
use App\Traits\EnumValues;

enum UserStatus: int
{
    use EnumValues, EnumOptions;

    case ACTIVE = 1;
    case LOCKED = 0;

    public function getBadge()
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::LOCKED => 'warning',
            default => '',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Hoạt động',
            self::LOCKED => 'Đã khóa',
            default => '',
        };
    }
}
