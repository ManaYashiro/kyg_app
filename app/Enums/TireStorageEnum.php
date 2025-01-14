<?php

namespace App\Enums;

enum TireStorageEnum: string
{
    case Void = "";
    case Yes = "有";
    case No = "無";

    public function getLabel(): string
    {
        return match ($this) {
            self::Void => "",
            self::Yes => "有効",
            self::No => "無効",
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::Void->value => self::Void->getLabel(),
            self::Yes->value => self::Yes->getLabel(),
            self::No->value => self::No->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
