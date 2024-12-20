<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Task_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_category')->insert([
            [
                'category_name' => '車検（00分開始）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => '車検（30分開始）',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => '点検整備・車検見積り',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => '車検（30分開始）土曜のみ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => '車検',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
