<?php

namespace App\Enums;

enum CallTimeEnum: string
{
    case A_09_12 = '09-12';
    case B_12_13 = '12-13';
    case C_13_15 = '13-15';
    case D_15_17 = '15-17';
    case E_17_19 = '17-19';
    case F_NASHI = 'no_preference';

    // return 電話連絡の希望時間帯 label
    public function getLabel(): string
    {
        return match ($this) {
            self::A_09_12 => '9:00 - 12:00',
            self::B_12_13 => '12:00 - 13:00',
            self::C_13_15 => '13:00 - 15:00',
            self::D_15_17 => '15:00 - 17:00',
            self::E_17_19 => '17:00 - 19:00',
            self::F_NASHI => '指定なし',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::A_09_12->value => self::A_09_12->getLabel(),
            self::B_12_13->value => self::B_12_13->getLabel(),
            self::C_13_15->value => self::C_13_15->getLabel(),
            self::D_15_17->value => self::D_15_17->getLabel(),
            self::E_17_19->value => self::E_17_19->getLabel(),
            self::F_NASHI->value => self::F_NASHI->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
