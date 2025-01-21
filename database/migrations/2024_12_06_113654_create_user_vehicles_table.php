<?php

use App\Models\User;
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
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->id()->comment('一意の識別子（主キー）');
            $table->foreignIdFor(User::class)->comment('ユーザーの識別子（外部キー）');
            $table->integer('sequence_no', 2)->autoIncrement(false)->comment('車両数No');
            $table->string('car_name', 20)->nullable()->comment('車名');
            $table->string('car_katashiki', 20)->nullable()->comment('型式');
            $table->string('transport_branch', 8)->nullable()->comment('運輸支局');
            $table->string('classification_no', 3)->nullable()->comment('分類番号');
            $table->string('kana', 2)->nullable()->comment('かな');
            $table->integer('serial_no')->nullable()->comment('一連指定番号');
            $table->string('car_class', 30)->nullable()->comment('車種区分');
            $table->dateTime('created_at')->useCurrent()->comment('作成日時（自動生成）');
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->comment('更新日時（自動生成）');
            $table->dateTime('deleted_at')->nullable()->comment('論理削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vehicles');
    }
};
