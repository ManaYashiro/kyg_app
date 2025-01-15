<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Appointments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $day_start = config('appointment.day_start');
        $day_end = config('appointment.day_end');
        $time_start = config('appointment.time_start');
        $time_end = config('appointment.time_end');
        $time_interval = config('appointment.time_interval');
        $break_day = config('appointment.break_day');
        $break_time = config('appointment.break_time');

        $startDate = Carbon::parse('2024-12-01');
        $endDate = Carbon::parse('2025-02-28');
        $currentDate = Carbon::parse($startDate);

        $startTime = Carbon::createFromFormat('H:i:s', $time_start);
        $endTime = Carbon::createFromFormat('H:i:s', $time_end);
        $intervalTime = Carbon::parse($time_interval);
        $intervalTime = $intervalTime->hour * 60 + $intervalTime->minute;

        while ($currentDate <= $endDate) {

            $currentTime = clone $startTime;

            if ($currentDate->dayOfWeek() === (int) $break_day) {
                $currentDate->addDay();
                continue;
            }

            // add one whole day of no appointment
            if ($currentDate->format('Y-m-d') === Carbon::parse('2025-01-20')->format('Y-m-d')) {
                $currentDate->addDay();
                continue;
            }

            // 09:00:00 ~ 18:00:00
            while ($currentTime < $endTime) {

                $cloneCurrentTime = clone $currentTime;
                $logTimeStart = $cloneCurrentTime->format('H:i:s');
                $logTimeEnd = $cloneCurrentTime->addMinutes($intervalTime)->format('H:i:s');

                $dateTimeStart = $currentDate->format('Y-m-d') . ' ' . $logTimeStart;
                $dateTimeEnd = $currentDate->format('Y-m-d') . ' ' . $logTimeEnd;

                $start = Carbon::parse($dateTimeStart)->format('Y-m-d\TH:i:s');
                $end = Carbon::parse($dateTimeEnd)->format('Y-m-d\TH:i:s');

                $currentTime->addMinutes($intervalTime);

                if ($logTimeStart !== $break_time) {


                    $stores = ['稲沢本店', '名古屋北店', '刈谷店', '錦店', '豊田上郷店', '犬山店'];
                    $randomStore = $stores[array_rand($stores)];
                    $inspection_type = ['車検', '定点', '一般'];
                    $randominspection_type = $inspection_type[array_rand($inspection_type)];
                    $work_type = [
                        'ラビット車検',
                        'ワンデー/一般車検',
                        'リース車検',
                        '12ヶ月点検',
                        '06ヶ月点検',
                        '03ヶ月点検',
                        'スケジュール点検',
                        'オイル交換',
                        'タイヤ交換',
                    ];
                    $randomwork_type = $work_type[array_rand($work_type)];
                    $customer_type = ['個人', '法人'];
                    $randomcustomer_type = $customer_type[array_rand($customer_type)];
                    $reservation_task_id = range(1, 25);
                    $randomreservation_task_id = $reservation_task_id[array_rand($reservation_task_id)];

                    $user = User::where('role', '!=', UserRoleEnum::Admin->value)->inRandomOrder()->first();

                    Appointments::factory()->create([
                        'user_id' => $user->id,
                        'user_vehicle_id' => $user->userVehicles[0]->id,
                        'store' => $randomStore,
                        'customer_name' => $user->name,
                        'reservation_datetime' => $start,
                        'inspection_due_date' => $currentDate->format('Y-m-d'),
                        'past_service_history' => "false",
                        'inspection_type' => $randominspection_type,
                        'work_type' => $randomwork_type,
                        'customer_type' => $randomcustomer_type,
                        'reservation_task_id' => $randomreservation_task_id,
                    ]);
                }
            }

            $currentDate->addDay();
        }
    }
}
