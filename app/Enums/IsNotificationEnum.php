<?php

namespace App\Enums;

enum IsNotificationEnum: int
{
    case Yes = 1;
    case No = 2;

    // return 店からのお知らせメール label
    public function getLabel(): string
    {
        return match ($this) {
            self::Yes => '受信する',
            self::No => '受信しない',
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
