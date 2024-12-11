<?php

namespace App\Enums;

enum IsNewsletterEnum: int
{
    case No = 0;
    case Yes = 1;

    // return メルマガ配信 label
    public function getLabel(): string
    {
        return match ($this) {
            self::No => '配信を希望しない',
            self::Yes => '配信を希望する',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::No->value => self::No->getLabel(),
            self::Yes->value => self::Yes->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
