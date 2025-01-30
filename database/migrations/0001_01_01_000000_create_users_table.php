<?php

use App\Enums\UserRoleEnum;
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
            $table->id()->comment("一意の識別子（主キー）");
            $table->string('role', 10)->default(UserRoleEnum::User->value)->comment("権限");
            $table->string('loginid', 120)->nullable(false)->comment("ログインID");
            $table->string('customer_no', 15)->unique()->nullable(false)->comment("会員番号");
            $table->integer('person_type', 1)->nullable()->autoIncrement(false)->comment("法人／個人区分 ; １：個人ｌ２：法人");
            $table->string('name', 40)->comment("顧客名");
            $table->string('name_furigana', 40)->comment("フリガナ");
            $table->string('email', 128)->unique()->comment("メールアドレス");
            $table->string('password', 60)->comment("パスワード");
            $table->dateTime('email_verified_at')->useCurrent()->nullable()->comment("");
            $table->integer('zipcode', 7)->nullable()->autoIncrement(false)->comment("郵便番号");
            $table->string('prefecture', 8)->nullable()->comment("都道府県");
            $table->string('address1', 150)->nullable()->comment("市区町村・番地");
            $table->string('address2')->nullable()->comment("建物名など");
            $table->string('phone_number', 15)->comment("電話番号");
            $table->integer('gender', 1)->nullable()->autoIncrement(false)->comment("性別");
            $table->date('birthday')->nullable()->comment("生年月日");
            $table->string('reg_device', 20)->nullable()->comment("デバイス");
            $table->string('reg_ipaddr', 15)->nullable()->comment("アクセスIP");
            $table->string('call_time', 15)->nullable()->comment("電話連絡の希望時間帯");
            $table->json('questionnaire')->nullable()->comment("アンケート");
            $table->string('manager', 40)->nullable()->comment("担当者");
            $table->string('department', 128)->nullable()->comment("部署名／支店名");
            $table->string('remarks', 128)->nullable()->comment("管理用備考");
            $table->integer('is_receive_newsletter', 1)->nullable()->autoIncrement(false)->comment("メルマガ配信; 0：するｌ１：しない");
            $table->integer('is_receive_notification', 1)->nullable()->autoIncrement(false)->comment("お知らせメール; 0：するｌ１：しない");
            $table->rememberToken()->comment("");
            $table->dateTime('created_at')->useCurrent()->comment("作成日時（自動生成）");
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->comment("更新日時（自動生成）");
            $table->dateTime('deleted_at')->nullable()->comment("論理削除日時");
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
