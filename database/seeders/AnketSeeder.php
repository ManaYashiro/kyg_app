<?php

namespace Database\Seeders;

use App\Models\Anket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anket::create([
            'name' => 'Google、Yahoo!等のインターネット広告',
            'short_name' => 'インターネット広告',
        ]);
        Anket::create([
            'name' => 'Youtube、Twitter、Facebook等のSNS',
            'short_name' => 'SNS',
        ]);
        Anket::create([
            'name' => '弊社のホームページ',
            'short_name' => 'HP',
        ]);
        Anket::create([
            'name' => '弊社からのご案内ハガキや郵便物',
            'short_name' => '郵便物',
        ]);
        Anket::create([
            'name' => '店頭のポップ看板・のぼり',
            'short_name' => '店頭看板',
        ]);
        Anket::create([
            'name' => '道路脇の看板やその他の屋外広告',
            'short_name' => '屋外広告',
        ]);
        Anket::create([
            'name' => '新聞の折込チラシ',
            'short_name' => '折込チラシ',
        ]);
        Anket::create([
            'name' => '地域情報誌・フリーペーパー',
            'short_name' => 'フリーペーパー',
        ]);
        Anket::create([
            'name' => '家族・知人からの紹介',
            'short_name' => '家族・知人からの紹介',
        ]);
        Anket::create([
            'name' => '職場や取引先からの紹介',
            'short_name' => '職場や取引先からの紹介',
        ]);
    }
}
