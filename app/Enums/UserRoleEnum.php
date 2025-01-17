<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case Admin = 'admin';
    case User = 'user';

    public function getLabel(): string
    {
        return match ($this) {
            self::Admin => '管理者',
            self::User => '一般',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::Admin->value => self::Admin->getLabel(),
            self::User->value => self::User->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
