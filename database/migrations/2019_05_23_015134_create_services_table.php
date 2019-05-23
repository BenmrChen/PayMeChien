<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            // 服務編號
            $table->increments('id');
            // 服務狀態
            $table->string('status', 1)->default('C');
            // 服務名稱
            $table->string('name', 80);
            // 服務介紹
            $table->text('introduction');
            // 服務價格
            $table->integer('price')->default('0');
            // 服務剩餘數量
            $table->integer('remain_count')->default('0');
            // 付款方式
            $table->string('payment_method', 80);
            // 付款週期(日)
            $table->integer('payment_period');
            // 建立/更新時間
            $table->timestamps();
            // 索引設定
            $table->index(['status'], 'service_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
