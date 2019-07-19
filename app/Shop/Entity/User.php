<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    // 資料表名稱
    protected $table = 'users';

    // 主鍵名稱
    Protected $primaryKey= 'id';

    // 可大量指定異動column
    protected $fillable = [
        "email",
        "password",
        "type",
        "nickname",
    ];
}
