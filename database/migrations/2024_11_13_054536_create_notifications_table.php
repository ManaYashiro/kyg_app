<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // 一意の識別子（主キー）
            $table->string('title')->comment('お知らせのタイトル'); // お知らせのタイトル
            $table->text('content')->comment('お知らせの内容'); // お知らせの内容
            $table->string('category')->comment('お知らせのカテゴリー');; // お知らせのカテゴリー
            $table->date('published_at')->nullable()->comment('公開日時（公開されている場合）'); // 公開日時（公開されている場合）
            $table->boolean('is_active')->default(true)->comment('お知らせの表示状態（公開/非公開）'); // お知らせの表示状態（公開/非公開）
            $table->string('image')->nullable()->comment('画像ファイル'); // 画像ファイル
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
