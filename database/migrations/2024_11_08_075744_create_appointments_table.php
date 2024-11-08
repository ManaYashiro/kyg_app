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
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('sort_number');
            $table->dateTime('reservation_datetime');
            $table->string('vehicle_name');
            $table->string('registration_number');
            $table->enum('vehicle_type', ['セダン', 'SUV', 'ワゴン', 'トラック','その他']);
            $table->string('license_plate');
            $table->date('inspection_due_date');
            $table->string('additional_services');
            $table->string('past_service_history');
            $table->text('message');
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
