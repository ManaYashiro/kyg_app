<?php

namespace Database\Seeders;

use App\Enums\CustomerTypeEnum;
use App\Enums\InspectionTypeEnum;
use App\Enums\ReservationNameEnum;
use App\Enums\TireStorageEnum;
use App\Enums\WorkTypeEnum;
use App\Models\ReservationTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // No 01
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleInspection->value,
            'work_type' => WorkTypeEnum::RabbitVehicleInspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::RabbitVehicleInspection45_00_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleInspection->value,
            'work_type' => WorkTypeEnum::RabbitVehicleInspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::RabbitVehicleInspection45_30_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 02
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleInspection->value,
            'work_type' => WorkTypeEnum::OneDayInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => "",
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 0,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleInspection->value,
            'work_type' => WorkTypeEnum::OneDayInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => "",
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 0,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 03
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleInspection->value,
            'work_type' => WorkTypeEnum::LeaseVehicleInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::QuickVehicleInspection_00_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleInspection->value,
            'work_type' => WorkTypeEnum::LeaseVehicleInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::QuickVehicleInspection_30_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 04
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months12Inspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::Months12Inspection_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months12Inspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::Months12Inspection_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months12Inspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::Months12Maintenance_60->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months12Inspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::Months24Maintenance_60->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 05
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months06Inspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::Months06Inspection_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months06Inspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::Months06Maintenance_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months06Inspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::Months18Maintenance_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months06Inspection->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::Months30Maintenance_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 06
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::VehicleFix->value,
            'work_type' => WorkTypeEnum::Months03Inspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::Months03Inspection_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        // No 07
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::ScheduleInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::ScheduleInspection_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::ScheduleInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::ScheduleInspectionAndTireChange_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::ScheduleInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::ScheduleInspectionAndTireChange_60->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::ScheduleInspection->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::UnicarInspection_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        // No 08
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::OilChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::EngineOilChange_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 1,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::OilChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::EngineOilChange_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::OilChange->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::EngineOilChange_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 1,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        // No 09
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::TireChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_TireOnly_60->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::TireChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_TireOnly_60->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::TireChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_TireOnly_60->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 10
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::SeasonChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::SeasonChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::SeasonChange->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::SeasonChange->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::General->value,
            'work_type' => WorkTypeEnum::SeasonChange->value,
            'customer_type' => CustomerTypeEnum::Corporate->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        // No 11
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::General->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::VehicleInspectionEstimate_30->value,
            'maintenance_flag' => 1,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 1,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        // No 99
        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Yes->value,
            'deadline' => 14,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::TireChange_WheelInc_30->value,
            'maintenance_flag' => 0,
            'management_flag' => 0,
            'has_tire_storage' => TireStorageEnum::No->value,
            'deadline' => 1,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::AV_StoreInstall->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::AV_SiteInstall->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 0,
            'site_flag_nagoyakita' => 0,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 0,
            'site_flag_toyota_kamigo' => 0,
            'site_flag_inuyama' => 0,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::KeeperFirstCoat->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::OtherSubMenu->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::KeeperMaintenanceCoat->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 0,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);

        ReservationTask::factory()->create([
            'inspection_type' => InspectionTypeEnum::Other->value,
            'work_type' => WorkTypeEnum::Admin->value,
            'customer_type' => CustomerTypeEnum::Private->value,
            'reservation_name' => ReservationNameEnum::GeneralStall->value,
            'maintenance_flag' => 0,
            'management_flag' => 1,
            'has_tire_storage' => TireStorageEnum::Void->value,
            'deadline' => 3,
            'site_flag_inazawa' => 1,
            'site_flag_nagoyakita' => 1,
            'site_flag_kariya' => 1,
            'site_flag_nishiki' => 1,
            'site_flag_toyota_kamigo' => 1,
            'site_flag_inuyama' => 1,
        ]);
    }
}
