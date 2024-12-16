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
            $table->string('loginid', 15)->nullable(false);
            $table->string('customer_no', 15)->unique()->nullable(false);
            $table->string('role', 10)->default(User::USER);
            $table->string('name', 100);
            $table->string('name_furigana', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->dateTime('email_verified_at')->useCurrent()->nullable();
            $table->integer('zipcode', 7)->autoIncrement(false);
            $table->string('prefecture', 8);
            $table->string('address1', 150);
            $table->string('address2')->nullable();
            $table->string('phone_number', 15);
            $table->integer('gender', 1)->nullable()->autoIncrement(false);
            $table->date('birthday');
            $table->string('reg_device', 20)->nullable();
            $table->string('reg_ipaddr', 15)->nullable();
            $table->string('call_time', 15)->nullable();
            $table->json('questionnaire')->nullable();
            $table->string('manager', 40)->nullable();
            $table->string('department', 128)->nullable();
            $table->string('remarks', 128)->nullable();
            $table->integer('is_receive_newsletter', 1)->nullable()->autoIncrement(false);
            $table->integer('is_receive_notification', 1)->autoIncrement(false);
            $table->rememberToken();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable();
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
