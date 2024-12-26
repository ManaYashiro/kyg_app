<?php

namespace App\Enums;

enum CarClassEnum: int
{
    case Keijidousha = 1;
    case KogataJouyousha = 2;
    case ChuugataJouyousha = 3;
    case OogataJouyousha2_0T = 4;
    case OogataJouyousha2_5T = 5;
    case Joukigai = 6;

    // return 車種区分 label
    public function getLabel(): string
    {
        return match ($this) {
            self::Keijidousha => '軽自動車',
            self::KogataJouyousha => '小型乗用車(車両重量～1.0t)',
            self::ChuugataJouyousha => '中型乗用車(車両重量～1.5t)',
            self::OogataJouyousha2_0T => '大型乗用車(車両重量～2.0t)',
            self::OogataJouyousha2_5T => '大型乗用車(車両重量～2.5t)',
            self::Joukigai => '上記以外',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::Keijidousha->value => self::Keijidousha->getLabel(),
            self::KogataJouyousha->value => self::KogataJouyousha->getLabel(),
            self::ChuugataJouyousha->value => self::ChuugataJouyousha->getLabel(),
            self::OogataJouyousha2_0T->value => self::OogataJouyousha2_0T->getLabel(),
            self::OogataJouyousha2_5T->value => self::OogataJouyousha2_5T->getLabel(),
            self::Joukigai->value => self::Joukigai->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
