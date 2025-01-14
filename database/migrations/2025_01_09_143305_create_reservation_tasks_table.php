<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_tasks', function (Blueprint $table) {
            $table->id()->comment("一意の識別子（主キー）");
            $table->string('inspection_type', 25)->nullable(false)->comment("点検種別");
            $table->string('work_type', 10)->nullable(false)->comment("作業種別");
            $table->string('customer_type', 10)->nullable(false)->comment("個人／法人区分");
            $table->integer('management_flag', 1)->autoIncrement(false)->comment("管理フラグ");
            $table->integer('maintenance_flag', 1)->autoIncrement(false)->comment("整備／用品区分");
            $table->string('reservation_name', 255)->nullable(false)->comment("予約する作業");
            $table->string('has_tire_storage', 10)->nullable(false)->default("")->comment("タイヤ預かりオプション");
            $table->integer('deadline', 2)->autoIncrement(false)->comment("受付締切");
            $table->integer('site_flag_inazawa', 1)->autoIncrement(false)->comment("拠点フラグ(稲沢)");
            $table->integer('site_flag_nagoyakita', 1)->autoIncrement(false)->comment("拠点フラグ(名古屋北)");
            $table->integer('site_flag_kariya', 1)->autoIncrement(false)->comment("拠点フラグ(刈谷)");
            $table->integer('site_flag_nishiki', 1)->autoIncrement(false)->comment("拠点フラグ(錦)");
            $table->integer('site_flag_toyota_kamigo', 1)->autoIncrement(false)->comment("拠点フラグ(豊田上郷)");
            $table->integer('site_flag_inuyama', 1)->autoIncrement(false)->comment("拠点フラグ(犬山)");
            $table->dateTime('created_at')->useCurrent()->comment("作成日時（自動生成）");
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->comment("更新日時（自動生成）");
            $table->dateTime('deleted_at')->nullable()->comment("論理削除日時");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_tasks');
    }
};
