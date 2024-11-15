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
            $table->unsignedBigInteger('user_id')->nullable()->comment('ユーザーID');
            $table->string('appoint_number')->nullable()->comment('予約番号');
            $table->tinyInteger('sort_number')->nullable()->comment('ソート番号');
            $table->dateTime('reservation_datetime')->nullable()->comment('予約日時');
            $table->string('vehicle_name')->nullable()->comment('車両名');
            $table->string('registration_number')->nullable()->comment('車両登録番号');
            $table->string('vehicle_type')->nullable()->comment('車両タイプ');
            $table->date('inspection_due_date')->nullable()->comment('車検満了日');
            $table->string('additional_services')->nullable()->comment('追加整備');
            $table->string('past_service_history')->nullable()->comment('過去利用履歴の有無');
            $table->text('message')->nullable()->comment('メッセージ');
            $table->timestamps();

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
