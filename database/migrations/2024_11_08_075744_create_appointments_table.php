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
            $table->text('reservation_number')->comment('予約番号');
            $table->dateTime('reservation_datetime')->comment('予約日時');
            $table->string('customer_name', 40)->comment('顧客名');
            $table->string('main_menu', 40)->nullable()->comment('メインメニュー名');
            $table->string('sub_menu', 40)->nullable()->comment('サブメニュー名');
            $table->string('store')->nullable()->comment('ご希望の店舗');
            $table->string('taskcategory')->nullable()->comment('作業カテゴリ');
            $table->string('reservationtask')->nullable()->comment('予約する作業');
            $table->string('vehicle', 20)->comment('車両台数');
            $table->string('additional_services', 255)->nullable()->comment('追加整備');
            $table->date('inspection_due_date')->comment('車検満了日');
            $table->string('past_service_history', 40)->comment('過去の利用履歴');
            $table->string('requirement')->nullable()->comment('予約ご要望');
            $table->integer('reservation_count')->nullable()->comment('予約数');
            $table->text('remarks')->nullable()->comment('備考欄');
            $table->integer('reservation_status')->nullable()->comment('予約状況');
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
