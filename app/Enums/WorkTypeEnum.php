<?php

namespace App\Enums;

use App\Helpers\Log;

enum WorkTypeEnum: string
{
    case RabbitVehicleInspection = "ラビット車検";
    case OneDayInspection = "ワンデー/一般車検";
    case LeaseVehicleInspection = "リース車検";
    case Months12Inspection = "12ヶ月点検";
    case Months06Inspection = "06ヶ月点検";
    case Months03Inspection = "03ヶ月点検";
    case ScheduleInspection = "スケジュール点検";
    case OilChange = "オイル交換";
    case TireChange = "タイヤ交換";
    case SeasonChange = "シーズンチェンジ";
    case General = "一般";
    case Admin = "管理";

    public function getLabel(): string
    {
        return match ($this) {
            self::RabbitVehicleInspection => 'ラビット車検',
            self::OneDayInspection => 'ワンデー/一般車検',
            self::LeaseVehicleInspection => 'リース車検',
            self::Months12Inspection => '12ヶ月点検',
            self::Months06Inspection => '06ヶ月点検',
            self::Months03Inspection => '03ヶ月点検',
            self::ScheduleInspection => 'スケジュール点検',
            self::OilChange => 'オイル交換',
            self::TireChange => 'タイヤ交換',
            self::SeasonChange => 'シーズンチェンジ',
            self::General => '一般',
            self::Admin => '管理',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::RabbitVehicleInspection->value => self::RabbitVehicleInspection->getLabel(),
            self::OneDayInspection->value => self::OneDayInspection->getLabel(),
            self::LeaseVehicleInspection->value => self::LeaseVehicleInspection->getLabel(),
            self::Months12Inspection->value => self::Months12Inspection->getLabel(),
            self::Months06Inspection->value => self::Months06Inspection->getLabel(),
            self::Months03Inspection->value => self::Months03Inspection->getLabel(),
            self::ScheduleInspection->value => self::ScheduleInspection->getLabel(),
            self::OilChange->value => self::OilChange->getLabel(),
            self::TireChange->value => self::TireChange->getLabel(),
            self::SeasonChange->value => self::SeasonChange->getLabel(),
            self::General->value => self::General->getLabel(),
            self::Admin->value => self::Admin->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }

    public static function shakenList(): array
    {
        return [
            self::RabbitVehicleInspection->value,
            self::OneDayInspection->value,
            self::LeaseVehicleInspection->value
        ];
    }

    public static function teitenList(): array
    {
        return [
            self::Months12Inspection->value,
            self::Months06Inspection->value,
            self::Months03Inspection->value,
            self::ScheduleInspection->value,
            self::OilChange->value,
            self::TireChange->value,
            self::SeasonChange->value,
            self::General->value,
            self::Admin->value
        ];
    }
}
