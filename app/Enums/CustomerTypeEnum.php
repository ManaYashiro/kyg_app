<?php

namespace App\Enums;

enum CustomerTypeEnum: string
{
    case Private = "個人";
    case Corporate = "法人";

    public function getLabel(): string
    {
        return match ($this) {
            self::Private => '個人',
            self::Corporate => '法人',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::Private->value => self::Private->getLabel(),
            self::Corporate->value => self::Corporate->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
