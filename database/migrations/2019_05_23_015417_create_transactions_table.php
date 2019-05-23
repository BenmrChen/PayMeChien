<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            // 交易編號
            $table->increments('id');
            // User編號
            $table->integer('user_id');
            // 服務編號
            $table->integer('service_id');
            // 購買時服務價格
            $table->integer('price');
            // 購買數量
            $table->integer('buy_count');
            // 交易總價格
            $table->integer('total_price');
            // 付款狀態，已付=T;未付=F
            $table->string('payment_status','1' )->default('F');
            // 匯款後5碼
            $table->integer('payment_number');
            // 付款核對，已核對=T;未核對=F; 這邊先採信任原則，不另作核對，預設為T
            $table->string('payment_check', '1')->default('T');
            // 建立/更新時間
            $table->timestamps();
            // 索引設定
            $table->index(['user_id'], 'user_transaction_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
