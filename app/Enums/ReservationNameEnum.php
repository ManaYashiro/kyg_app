<?php

namespace App\Enums;

enum ReservationNameEnum: string
{
    case RabbitVehicleInspection45_00_60 = "車検ラビット４５（00分開始）（60分）";
    case RabbitVehicleInspection45_30_60 = "車検ラビット４５（30分開始）（60分）";
    case QuickVehicleInspection_00_60 = "ご来店型クイック車検（00分開始）（60分）";
    case QuickVehicleInspection_30_60 = "ご来店型クイック車検（30分開始）（60分）";
    case Months12Inspection_60 = "12ヶ月点検（60分）";
    case Months12Maintenance_60 = "メンテパック12ヶ月点検（60分）";
    case Months24Maintenance_60 = "メンテパック24ヶ月点検（60分）";
    case Months06Inspection_60 = "6ヶ月点検（60分）";
    case Months06Maintenance_30 = "メンテパック6ヶ月点検（30分）";
    case Months18Maintenance_30 = "メンテパック18ヶ月点検（30分）";
    case Months30Maintenance_30 = "メンテパック30ヶ月点検（30分）";
    case Months03Inspection_30 = "3ヶ月点検（30分）";
    case ScheduleInspection_30 = "スケジュール点検（30分）";
    case ScheduleInspectionAndTireChange_60 = "スケジュール点検＋タイヤ付替え（60分）";
    case UnicarInspection_30 = "ユニカー点検（30分）";
    case EngineOilChange_30 = "エンジンオイル交換（30分）";
    case TireChange_TireOnly_60 = "タイヤ付替え[タイヤのみ](60分）";
    case TireChange_WheelInc_30 = "タイヤ付替え[ホイール付](30分)";
    case VehicleInspectionEstimate_30 = "車検見積り（30分）";
    case AV_StoreInstall = "ＡＶ作業_店舗取付";
    case AV_SiteInstall = "ＡＶ作業_出張取付";
    case KeeperFirstCoat = "キーパー初回コート";
    case OtherSubMenu = "その他サブメニュー等";
    case KeeperMaintenanceCoat = "キーパーメンテコート";
    case GeneralStall = "汎用ストール（追加・削除）";

    public function getLabel(): string
    {
        return match ($this) {
            self::RabbitVehicleInspection45_00_60 => '車検ラビット４５（00分開始）（60分）',
            self::RabbitVehicleInspection45_30_60 => '車検ラビット４５（30分開始）（60分）',
            self::QuickVehicleInspection_00_60 => 'ご来店型クイック車検（00分開始）（60分）',
            self::QuickVehicleInspection_30_60 => 'ご来店型クイック車検（30分開始）（60分）',
            self::Months12Inspection_60 => '12ヶ月点検（60分）',
            self::Months12Maintenance_60 => 'メンテパック12ヶ月点検（60分）',
            self::Months24Maintenance_60 => 'メンテパック24ヶ月点検（60分）',
            self::Months06Inspection_60 => '6ヶ月点検（60分）',
            self::Months06Maintenance_30 => 'メンテパック6ヶ月点検（30分）',
            self::Months18Maintenance_30 => 'メンテパック18ヶ月点検（30分）',
            self::Months30Maintenance_30 => 'メンテパック30ヶ月点検（30分）',
            self::Months03Inspection_30 => '3ヶ月点検（30分）',
            self::ScheduleInspection_30 => 'スケジュール点検（30分）',
            self::ScheduleInspectionAndTireChange_60 => 'スケジュール点検＋タイヤ付替え（60分）',
            self::UnicarInspection_30 => 'ユニカー点検（30分）',
            self::EngineOilChange_30 => 'エンジンオイル交換（30分）',
            self::TireChange_TireOnly_60 => 'タイヤ付替え[タイヤのみ](60分）',
            self::TireChange_WheelInc_30 => 'タイヤ付替え[ホイール付](30分)',
            self::VehicleInspectionEstimate_30 => '車検見積り（30分）',
            self::AV_StoreInstall => 'ＡＶ作業_店舗取付',
            self::AV_SiteInstall => 'ＡＶ作業_出張取付',
            self::KeeperFirstCoat => 'キーパー初回コート',
            self::OtherSubMenu => 'その他サブメニュー等',
            self::KeeperMaintenanceCoat => 'キーパーメンテコート',
            self::GeneralStall => 'キーパーメンテコート',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::RabbitVehicleInspection45_00_60->value => self::RabbitVehicleInspection45_00_60->getLabel(),
            self::RabbitVehicleInspection45_30_60->value => self::RabbitVehicleInspection45_30_60->getLabel(),
            self::QuickVehicleInspection_00_60->value => self::QuickVehicleInspection_00_60->getLabel(),
            self::QuickVehicleInspection_30_60->value => self::QuickVehicleInspection_30_60->getLabel(),
            self::Months12Inspection_60->value => self::Months12Inspection_60->getLabel(),
            self::Months12Maintenance_60->value => self::Months12Maintenance_60->getLabel(),
            self::Months24Maintenance_60->value => self::Months24Maintenance_60->getLabel(),
            self::Months06Inspection_60->value => self::Months06Inspection_60->getLabel(),
            self::Months06Maintenance_30->value => self::Months06Maintenance_30->getLabel(),
            self::Months18Maintenance_30->value => self::Months18Maintenance_30->getLabel(),
            self::Months30Maintenance_30->value => self::Months30Maintenance_30->getLabel(),
            self::Months03Inspection_30->value => self::Months03Inspection_30->getLabel(),
            self::ScheduleInspection_30->value => self::ScheduleInspection_30->getLabel(),
            self::ScheduleInspectionAndTireChange_60->value => self::ScheduleInspectionAndTireChange_60->getLabel(),
            self::UnicarInspection_30->value => self::UnicarInspection_30->getLabel(),
            self::EngineOilChange_30->value => self::EngineOilChange_30->getLabel(),
            self::TireChange_TireOnly_60->value => self::TireChange_TireOnly_60->getLabel(),
            self::TireChange_WheelInc_30->value => self::TireChange_WheelInc_30->getLabel(),
            self::VehicleInspectionEstimate_30->value => self::VehicleInspectionEstimate_30->getLabel(),
            self::AV_StoreInstall->value => self::AV_StoreInstall->getLabel(),
            self::AV_SiteInstall->value => self::AV_SiteInstall->getLabel(),
            self::KeeperFirstCoat->value => self::KeeperFirstCoat->getLabel(),
            self::OtherSubMenu->value => self::OtherSubMenu->getLabel(),
            self::KeeperMaintenanceCoat->value => self::KeeperMaintenanceCoat->getLabel(),
            self::GeneralStall->value => self::GeneralStall->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
