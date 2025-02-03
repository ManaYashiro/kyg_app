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
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('reservation_number', 15)->comment('予約番号');
            $table->dateTime('reservation_datetime')->comment('予約日時');
            $table->string('customer_name', 40)->comment('顧客名');
            $table->string('store', 255)->comment('ご希望の店舗');
            $table->string('inspection_type', 25)->comment('点検種別');
            $table->string('work_type', 10)->comment('作業種別');
            $table->string('customer_type', 10)->comment('個人/法人区分');
            $table->integer('reservation_task_id')->nullable()->comment('作業詳細');
            $table->integer('user_vehicle_id')->autoIncrement(false)->comment('車両ID');
            $table->string('additional_services', 255)->nullable()->comment('追加整備');
            $table->date('inspection_due_date')->comment('車検満期日');
            $table->string('past_service_history', 40)->comment('過去の利用履歴');
            $table->string('remarks', 1024)->nullable()->comment('備考欄');
            $table->integer('reservation_status')->comment('予約状況');
            $table->string('admin_notes', 128)->nullable()->comment('管理メモ');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable();

            //外部キー
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
