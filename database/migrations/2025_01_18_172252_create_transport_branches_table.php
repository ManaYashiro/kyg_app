<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // テーブルを作成
        Schema::create('transport_branches', function (Blueprint $table) {
            $table->id()->comment('一意の識別子（主キー）');
            $table->string('branch_name', 255)->comment('運輸支局名');
            $table->integer('display_order')->comment('表示順');
            $table->string('branch_name_kana', 255)->comment('運輸支局名（カナ）');
            $table->datetime('created_at')->nullable()->comment('作成日時');
            $table->datetime('updated_at')->nullable()->comment('更新日時');
        });

        // データを挿入
        $data = [
            ['branch_name' => '札幌', 'display_order' => 20, 'branch_name_kana' => 'ｻﾂﾎﾟﾛ'],
            ['branch_name' => '函館', 'display_order' => 21, 'branch_name_kana' => 'ﾊｺﾀﾞﾃ'],
            ['branch_name' => '室蘭', 'display_order' => 22, 'branch_name_kana' => 'ﾑﾛﾗﾝ'],
            ['branch_name' => '苫小牧', 'display_order' => 27, 'branch_name_kana' => 'ﾄﾏｺﾏｲ'],
            ['branch_name' => '帯広', 'display_order' => 23, 'branch_name_kana' => 'ｵﾋﾞﾋﾛ'],
            ['branch_name' => '釧路', 'display_order' => 24, 'branch_name_kana' => 'ｸｼﾛ'],
            ['branch_name' => '知床', 'display_order' => 28, 'branch_name_kana' => 'ｼﾚﾄｺ'],
            ['branch_name' => '北見', 'display_order' => 25, 'branch_name_kana' => 'ｷﾀﾐ'],
            ['branch_name' => '旭川', 'display_order' => 26, 'branch_name_kana' => 'ｱｻﾋｶﾜ'],
            ['branch_name' => '宮城', 'display_order' => 36, 'branch_name_kana' => 'ﾐﾔｷﾞ'],
            ['branch_name' => '仙台', 'display_order' => 37, 'branch_name_kana' => 'ｾﾝﾀﾞｲ'],
            ['branch_name' => '福島', 'display_order' => 38, 'branch_name_kana' => 'ﾌｸｼﾏ'],
            ['branch_name' => '会津', 'display_order' => 40, 'branch_name_kana' => 'ｱｲﾂﾞ'],
            ['branch_name' => '郡山', 'display_order' => 41, 'branch_name_kana' => 'ｺｵﾘﾔﾏ'],
            ['branch_name' => '白河', 'display_order' => 42, 'branch_name_kana' => 'ｼﾗｶﾜ'],
            ['branch_name' => 'いわき', 'display_order' => 39, 'branch_name_kana' => 'ｲﾜｷ'],
            ['branch_name' => '岩手', 'display_order' => 32, 'branch_name_kana' => 'ｲﾜﾃ'],
            ['branch_name' => '盛岡', 'display_order' => 33, 'branch_name_kana' => 'ﾓﾘｵｶ'],
            ['branch_name' => '平泉', 'display_order' => 34, 'branch_name_kana' => 'ﾋﾗｲｽﾞﾐ'],
            ['branch_name' => '青森', 'display_order' => 29, 'branch_name_kana' => 'ｱｵﾓﾘ'],
            ['branch_name' => '弘前', 'display_order' => 31, 'branch_name_kana' => 'ﾋﾛｻｷ'],
            ['branch_name' => '八戸', 'display_order' => 30, 'branch_name_kana' => 'ﾊﾁﾉﾍ'],
            ['branch_name' => '新潟', 'display_order' => 87, 'branch_name_kana' => 'ﾆｲｶﾞﾀ'],
            ['branch_name' => '上越', 'display_order' => 89, 'branch_name_kana' => 'ｼﾞﾖｳｴﾂ'],
            ['branch_name' => '長岡', 'display_order' => 88, 'branch_name_kana' => 'ﾅｶﾞｵｶ'],
            ['branch_name' => '長野', 'display_order' => 90, 'branch_name_kana' => 'ﾅｶﾞﾉ'],
            ['branch_name' => '松本', 'display_order' => 91, 'branch_name_kana' => 'ﾏﾂﾓﾄ'],
            ['branch_name' => '諏訪', 'display_order' => 92, 'branch_name_kana' => 'ｽﾜ'],
            ['branch_name' => '山形', 'display_order' => 43, 'branch_name_kana' => 'ﾔﾏｶﾞﾀ'],
            ['branch_name' => '庄内', 'display_order' => 44, 'branch_name_kana' => 'ｼﾖｳﾅｲ'],
            ['branch_name' => '秋田', 'display_order' => 35, 'branch_name_kana' => 'ｱｷﾀ'],
            ['branch_name' => '品川', 'display_order' => 73, 'branch_name_kana' => 'ｼﾅｶﾞﾜ'],
            ['branch_name' => '世田谷', 'display_order' => 78, 'branch_name_kana' => 'ｾﾀｶﾞﾔ'],
            ['branch_name' => '足立', 'display_order' => 74, 'branch_name_kana' => 'ｱﾀﾞﾁ'],
            ['branch_name' => '江東', 'display_order' => 79, 'branch_name_kana' => 'ｺｳﾄｳ'],
            ['branch_name' => '葛飾', 'display_order' => 80, 'branch_name_kana' => 'ｶﾂｼｶ'],
            ['branch_name' => '練馬', 'display_order' => 75, 'branch_name_kana' => 'ﾈﾘﾏ'],
            ['branch_name' => '杉並', 'display_order' => 81, 'branch_name_kana' => 'ｽｷﾞﾅﾐ'],
            ['branch_name' => '板橋', 'display_order' => 82, 'branch_name_kana' => 'ｲﾀﾊﾞｼ'],
            ['branch_name' => '多摩', 'display_order' => 76, 'branch_name_kana' => 'ﾀﾏ'],
            ['branch_name' => '八王子', 'display_order' => 77, 'branch_name_kana' => 'ﾊﾁｵｳｼﾞ'],
            ['branch_name' => '横浜', 'display_order' => 83, 'branch_name_kana' => 'ﾖｺﾊﾏ'],
            ['branch_name' => '相模', 'display_order' => 84, 'branch_name_kana' => 'ｻｶﾞﾐ'],
            ['branch_name' => '川崎', 'display_order' => 85, 'branch_name_kana' => 'ｶﾜｻｷ'],
            ['branch_name' => '湘南', 'display_order' => 86, 'branch_name_kana' => 'ｼﾖｳﾅﾝ'],
            ['branch_name' => '千葉', 'display_order' => 56, 'branch_name_kana' => 'ﾁﾊﾞ'],
            ['branch_name' => '成田', 'display_order' => 60, 'branch_name_kana' => 'ﾅﾘﾀ'],
            ['branch_name' => '習志野', 'display_order' => 57, 'branch_name_kana' => 'ﾅﾗｼﾉ'],
            ['branch_name' => '市川', 'display_order' => 61, 'branch_name_kana' => 'ｲﾁｶﾜ'],
            ['branch_name' => '船橋', 'display_order' => 62, 'branch_name_kana' => 'ﾌﾅﾊﾞｼ'],
            ['branch_name' => '袖ヶ浦', 'display_order' => 58, 'branch_name_kana' => 'ｿﾃﾞｶﾞｳﾗ'],
            ['branch_name' => '市原', 'display_order' => 63, 'branch_name_kana' => 'ｲﾁﾊﾗ'],
            ['branch_name' => '野田', 'display_order' => 59, 'branch_name_kana' => 'ﾉﾀﾞ'],
            ['branch_name' => '柏', 'display_order' => 64, 'branch_name_kana' => 'ｶｼﾜ'],
            ['branch_name' => '松戸', 'display_order' => 65, 'branch_name_kana' => 'ﾏﾂﾄﾞ'],
            ['branch_name' => '大宮', 'display_order' => 66, 'branch_name_kana' => 'ｵｵﾐﾔ'],
            ['branch_name' => '川口', 'display_order' => 70, 'branch_name_kana' => 'ｶﾜｸﾞﾁ'],
            ['branch_name' => '熊谷', 'display_order' => 67, 'branch_name_kana' => 'ｸﾏｶﾞﾔ'],
            ['branch_name' => '所沢', 'display_order' => 68, 'branch_name_kana' => 'ﾄｺﾛｻﾞﾜ'],
            ['branch_name' => '川越', 'display_order' => 71, 'branch_name_kana' => 'ｶﾜｺﾞｴ'],
            ['branch_name' => '春日部', 'display_order' => 69, 'branch_name_kana' => 'ｶｽｶﾍﾞ'],
            ['branch_name' => '越谷', 'display_order' => 72, 'branch_name_kana' => 'ｺｼｶﾞﾔ'],
            ['branch_name' => '水戸', 'display_order' => 46, 'branch_name_kana' => 'ﾐﾄ'],
            ['branch_name' => '土浦', 'display_order' => 47, 'branch_name_kana' => 'ﾂﾁｳﾗ'],
            ['branch_name' => 'つくば', 'display_order' => 48, 'branch_name_kana' => 'ﾂｸﾊﾞ'],
            ['branch_name' => '群馬', 'display_order' => 49, 'branch_name_kana' => 'ｸﾞﾝﾏ'],
            ['branch_name' => '高崎', 'display_order' => 50, 'branch_name_kana' => 'ﾀｶｻｷ'],
            ['branch_name' => '前橋', 'display_order' => 51, 'branch_name_kana' => 'ﾏｴﾊﾞｼ'],
            ['branch_name' => '宇都宮', 'display_order' => 53, 'branch_name_kana' => 'ｳﾂﾉﾐﾔ'],
            ['branch_name' => '那須', 'display_order' => 55, 'branch_name_kana' => 'ﾅｽ'],
            ['branch_name' => 'とちぎ', 'display_order' => 54, 'branch_name_kana' => 'ﾄﾁｷﾞ(ｶﾅ)'],
            ['branch_name' => '山梨', 'display_order' => 93, 'branch_name_kana' => 'ﾔﾏﾅｼ'],
            ['branch_name' => '名古屋', 'display_order' => 1, 'branch_name_kana' => 'ﾅｺﾞﾔ'],
            ['branch_name' => '三河', 'display_order' => 2, 'branch_name_kana' => 'ﾐｶﾜ'],
            ['branch_name' => '岡崎', 'display_order' => 5, 'branch_name_kana' => 'ｵｶｻﾞｷ'],
            ['branch_name' => '豊田', 'display_order' => 6, 'branch_name_kana' => 'ﾄﾖﾀ'],
            ['branch_name' => '尾張小牧', 'display_order' => 3, 'branch_name_kana' => 'ｵﾜﾘｺﾏｷ'],
            ['branch_name' => '一宮', 'display_order' => 7, 'branch_name_kana' => 'ｲﾁﾉﾐﾔ'],
            ['branch_name' => '春日井', 'display_order' => 8, 'branch_name_kana' => 'ｶｽｶﾞｲ'],
            ['branch_name' => '豊橋', 'display_order' => 4, 'branch_name_kana' => 'ﾄﾖﾊｼ'],
            ['branch_name' => '静岡', 'display_order' => 15, 'branch_name_kana' => 'ｼｽﾞｵｶ'],
            ['branch_name' => '浜松', 'display_order' => 16, 'branch_name_kana' => 'ﾊﾏﾏﾂ'],
            ['branch_name' => '沼津', 'display_order' => 17, 'branch_name_kana' => 'ﾇﾏﾂﾞ'],
            ['branch_name' => '伊豆', 'display_order' => 18, 'branch_name_kana' => 'ｲｽﾞ'],
            ['branch_name' => '富士山', 'display_order' => 19, 'branch_name_kana' => 'ﾌｼﾞｻﾝ'],
            ['branch_name' => '岐阜', 'display_order' => 9, 'branch_name_kana' => 'ｷﾞﾌ'],
            ['branch_name' => '飛騨', 'display_order' => 10, 'branch_name_kana' => 'ﾋﾀﾞ'],
            ['branch_name' => '三重', 'display_order' => 11, 'branch_name_kana' => 'ﾐｴ'],
            ['branch_name' => '鈴鹿', 'display_order' => 12, 'branch_name_kana' => 'ｽｽﾞｶ'],
            ['branch_name' => '伊勢志摩', 'display_order' => 13, 'branch_name_kana' => 'ｲｾｼﾏ'],
            ['branch_name' => '四日市', 'display_order' => 14, 'branch_name_kana' => 'ﾖﾂｶｲﾁ'],
            ['branch_name' => '福井', 'display_order' => 97, 'branch_name_kana' => 'ﾌｸｲ'],
            ['branch_name' => '石川', 'display_order' => 95, 'branch_name_kana' => 'ｲｼｶﾜ'],
            ['branch_name' => '金沢', 'display_order' => 96, 'branch_name_kana' => 'ｶﾅｻﾞﾜ'],
            ['branch_name' => '富山', 'display_order' => 94, 'branch_name_kana' => 'ﾄﾔﾏ'],
            ['branch_name' => '大阪', 'display_order' => 102, 'branch_name_kana' => 'ｵｵｻｶ'],
            ['branch_name' => '和泉', 'display_order' => 103, 'branch_name_kana' => 'ｲｽﾞﾐ'],
            ['branch_name' => '堺', 'display_order' => 105, 'branch_name_kana' => 'ｻｶｲ'],
            ['branch_name' => 'なにわ', 'display_order' => 104, 'branch_name_kana' => 'ﾅﾆﾜ'],
            ['branch_name' => '京都', 'display_order' => 106, 'branch_name_kana' => 'ｷﾖｳﾄ'],
            ['branch_name' => '神戸', 'display_order' => 107, 'branch_name_kana' => 'ｺｳﾍﾞ'],
            ['branch_name' => '姫路', 'display_order' => 108, 'branch_name_kana' => 'ﾋﾒｼﾞ'],
            ['branch_name' => '滋賀', 'display_order' => 98, 'branch_name_kana' => 'ｼｶﾞ'],
            ['branch_name' => '奈良', 'display_order' => 99, 'branch_name_kana' => 'ﾅﾗ'],
            ['branch_name' => '飛鳥', 'display_order' => 100, 'branch_name_kana' => 'ｱｽｶ'],
            ['branch_name' => '和歌山', 'display_order' => 101, 'branch_name_kana' => 'ﾜｶﾔﾏ'],
            ['branch_name' => '広島', 'display_order' => 114, 'branch_name_kana' => 'ﾋﾛｼﾏ'],
            ['branch_name' => '福山', 'display_order' => 115, 'branch_name_kana' => 'ﾌｸﾔﾏ'],
            ['branch_name' => '鳥取', 'display_order' => 109, 'branch_name_kana' => 'ﾄﾂﾄﾘ'],
            ['branch_name' => '島根', 'display_order' => 112, 'branch_name_kana' => 'ｼﾏﾈ'],
            ['branch_name' => '出雲', 'display_order' => 113, 'branch_name_kana' => 'ｲｽﾞﾓ'],
            ['branch_name' => '岡山', 'display_order' => 110, 'branch_name_kana' => 'ｵｶﾔﾏ'],
            ['branch_name' => '倉敷', 'display_order' => 111, 'branch_name_kana' => 'ｸﾗｼｷ'],
            ['branch_name' => '山口', 'display_order' => 116, 'branch_name_kana' => 'ﾔﾏｸﾞﾁ'],
            ['branch_name' => '下関', 'display_order' => 117, 'branch_name_kana' => 'ｼﾓﾉｾｷ'],
            ['branch_name' => '香川', 'display_order' => 118, 'branch_name_kana' => 'ｶｶﾞﾜ'],
            ['branch_name' => '高松', 'display_order' => 119, 'branch_name_kana' => 'ﾀｶﾏﾂ'],
            ['branch_name' => '徳島', 'display_order' => 120, 'branch_name_kana' => 'ﾄｸｼﾏ'],
            ['branch_name' => '愛媛', 'display_order' => 121, 'branch_name_kana' => 'ｴﾋﾒ'],
            ['branch_name' => '高知', 'display_order' => 123, 'branch_name_kana' => 'ｺｳﾁ'],
            ['branch_name' => '福岡', 'display_order' => 124, 'branch_name_kana' => 'ﾌｸｵｶ'],
            ['branch_name' => '北九州', 'display_order' => 125, 'branch_name_kana' => 'ｷﾀｷﾕｳｼﾕｳ'],
            ['branch_name' => '久留米', 'display_order' => 126, 'branch_name_kana' => 'ｸﾙﾒ'],
            ['branch_name' => '佐賀', 'display_order' => 122, 'branch_name_kana' => 'ｻｶﾞ'],
            ['branch_name' => '長崎', 'display_order' => 127, 'branch_name_kana' => 'ﾅｶﾞｻｷ'],
            ['branch_name' => '大分', 'display_order' => 128, 'branch_name_kana' => 'ｵｵｲﾀ'],
            ['branch_name' => '熊本', 'display_order' => 129, 'branch_name_kana' => 'ｸﾏﾓﾄ'],
            ['branch_name' => '鹿児島', 'display_order' => 130, 'branch_name_kana' => 'ｶｺﾞｼﾏ'],
            ['branch_name' => '宮崎', 'display_order' => 131, 'branch_name_kana' => 'ﾐﾔｻﾞｷ'],
            ['branch_name' => '沖縄', 'display_order' => 132, 'branch_name_kana' => 'ｵｷﾅﾜ'],
        ];

        DB::table('transport_branches')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_branches');
    }
};
