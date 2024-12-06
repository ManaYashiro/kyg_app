<?php

namespace App\Enums;

enum IsNotificationEnum: int
{
    case No = 0;
    case Yes = 1;

    // return 店からのお知らせメール label
    public function getLabel(): string
    {
        return match ($this) {
            self::No => '受けしない',
            self::Yes => '受けする',
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
