<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Task_reservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_reservation')->insert([
            [
                'reservation_name' => '★個人★車検ラビット４５（00分開始）（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆ご来店型クイック車検（00分開始）（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★車検ラビット４５（30分開始）（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆ご来店型クイック車検（30分開始）（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★車検ラビット４５（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆ご来店型クイック車検（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★車検見積り（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆スケジュール点検（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆ユニカー点検（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆スケジュール点検＋タイヤ付替え（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★12ヶ月点検（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆12ヶ月点検（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆6ヶ月点検（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★タイヤ付替え[ホイール付](30分)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★法人★タイヤ付替え[ホイール付](30分)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★タイヤ付替え[タイヤのみ](60分)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '個人エンジンオイル交換',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '★個人★エンジンオイル交換（30分） ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => '☆法人☆エンジンオイル交換（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => 'メンテパック6ヶ月点検（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => 'メンテパック12ヶ月点検（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => 'メンテパック18ヶ月点検（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => 'メンテパック24ヶ月点検（60分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_name' => 'メンテパック30ヶ月点検（30分）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
