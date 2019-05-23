<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // USER編號
            $table->increments('id');
            // Email
            $table->string('email', 150);
            // 密碼
            $table->string('password', 60);
            // 暱稱
            $table->string('nickname', 50);
            // 帳號類型
            $table->string('type',1)->default('G');
            // 建立/更新時間
            $table->timestamps();
            // 唯一鍵值索引
            $table->unique(['email'],'user_email_uk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
