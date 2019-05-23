<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // 資料表名稱
    protected $table = 'services';

    // 主鍵名稱
    protected $primaryKey = 'id';

    // 可大量指定異動column
    protected $fillable = [
        "id",
        "status",
        "name",
        "introduction",
        "price",
        "remain_count",
        "payment_method",
        "payment_period",
    ];
}
