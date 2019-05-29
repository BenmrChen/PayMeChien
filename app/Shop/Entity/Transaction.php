<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // 資料表名稱
    protected $table = "transactions";

    // 主鍵名稱
    protected $primaryKey = "id";

    // 可大量指定異動column
    protected $fillable = [
        "id",
        "user_id",
        "service_id",
        "price",
        "buy_count",
        "total_price",
        "payment_status",
        "payment_number",
        "payment_check",
    ];



    // 設定關聯資料 意即這個Model和Service的Model有關係
    public function Service() {
        return $this->hasOne('App\Shop\Entity\Service', 'id', 'service_id');
    }
}
