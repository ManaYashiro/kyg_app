<?php

return [
    'day_start' => (env('APPOINTMENT_DAY_START', \Carbon\Carbon::MONDAY)),
    'day_end' => (env('APPOINTMENT_DAY_END', \Carbon\Carbon::SUNDAY)),

    'break_time' => (env('APPOINTMENT_BREAK_TIME', '09:00:00')),
    'break_day' => (env('APPOINTMENT_BREAK_DAY', \Carbon\Carbon::WEDNESDAY)),

    'time_start' => env('APPOINTMENT_TIME_START', '09:00:00'),
    'time_end' => env('APPOINTMENT_TIME_END', '19:00:00'),
    'time_interval' => env('APPOINTMENT_TIME_INTERVAL', '01:00:00'),
];
