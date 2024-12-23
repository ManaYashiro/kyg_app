<?php

namespace App\Enums;

enum IsNewsletterEnum: int
{
    case Yes = 1;
    case No = 2;

    // return メルマガ配信 label
    public function getLabel(): string
    {
        return match ($this) {
            self::Yes => '配信を希望する',
            self::No => '配信を希望しない',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::Yes->value => self::Yes->getLabel(),
            self::No->value => self::No->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
