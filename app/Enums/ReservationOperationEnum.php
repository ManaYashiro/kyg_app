<?php

namespace App\Enums;

enum ReservationOperationEnum: string
{
    case Admin = "admin";
    case Management = "management";

    public function getLabel(): string
    {
        return match ($this) {
            self::Admin => '管理',
            self::Management => '整備',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::Admin->value => self::Admin->getLabel(),
            self::Management->value => self::Management->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
