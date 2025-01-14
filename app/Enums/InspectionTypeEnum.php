<?php

namespace App\Enums;

enum InspectionTypeEnum: string
{
    case VehicleInspection = "車検";
    case VehicleFix = "定点";
    case General = "一般";
    case Other = "その他";

    public function getLabel(): string
    {
        return match ($this) {
            self::VehicleInspection => '車検',
            self::VehicleFix => '定点',
            self::General => '一般',
            self::Other => 'その他',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::VehicleInspection->value => self::VehicleInspection->getLabel(),
            self::VehicleFix->value => self::VehicleFix->getLabel(),
            self::General->value => self::General->getLabel(),
            self::Other->value => self::Other->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
