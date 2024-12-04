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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('loginid', 10)->nullable(false);
            $table->string('role', 10)->default(User::USER);
            $table->string('name', 100);
            $table->string('furigana', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->dateTime('email_verified_at')->useCurrent()->nullable();
            $table->string('phone_number', 15);
            $table->integer('post_code', 10)->autoIncrement(false);
            $table->string('address', 150);
            $table->string('building')->nullable();
            $table->string('preferred_contact_time', 15)->nullable();
            $table->json('how_did_you_hear')->nullable();
            $table->boolean('is_receive_newsletter')->default(FALSE);
            $table->boolean('is_receive_notification')->default(FALSE);
            $table->rememberToken();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->dateTime('created_at')->useCurrent()->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
