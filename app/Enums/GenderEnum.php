<?php

namespace App\Enums;

enum GenderEnum: int
{
    case Male = 0;
    case Female = 1;

    // return 性別 label
    public function getLabel(): string
    {
        return match ($this) {
            self::Male => '男性',
            self::Female => '女性',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::Male->value => self::Male->getLabel(),
            self::Female->value => self::Female->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
