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
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('car1_name', 20)->nullable(false);
            $table->string('car1_katashiki', 20)->nullable();
            $table->string('car1_number', 20)->nullable(false);
            $table->string('car1_class', 30)->nullable();
            $table->string('car2_name', 20)->nullable();
            $table->string('car2_katashiki', 20)->nullable();
            $table->string('car2_number', 20)->nullable();
            $table->string('car2_class', 30)->nullable();
            $table->string('car3_name', 20)->nullable();
            $table->string('car3_katashiki', 20)->nullable();
            $table->string('car3_number', 20)->nullable();
            $table->string('car3_class', 30)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
