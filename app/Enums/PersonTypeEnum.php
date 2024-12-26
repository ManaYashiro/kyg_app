<?php

namespace App\Enums;

enum PersonTypeEnum: int
{
    case Private = 1;
    case Corporate = 2;

    // return 性別 label
    public function getLabel(): string
    {
        return match ($this) {
            self::Private => '個人',
            self::Corporate => '法人',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::Private->value => self::Private->getLabel(),
            self::Corporate->value => self::Corporate->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
