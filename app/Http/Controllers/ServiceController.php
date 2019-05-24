<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop\Entity\Service;
use App\Shop\Entity\Transaction;
use App\Shop\Entity\User;
use DB;
use Exception;
use Validator;




class ServiceController extends Controller {
    // 商品服務清單檢視
    public function serviceListPage() {
        // 每頁數量
        $row_per_page = 10;
        // 撈取商品服務分頁資料
        $ServicePaginate = Service::OrderBy('updated_at', 'desc')
            ->where('status', "S") // 販售中
            ->paginate($row_per_page);

        $binding = [
            'title' => '商品服務列表',
            'ServicePaginate' => $ServicePaginate,
        ];

        return view('service.listService', $binding);
    }

    // 服務單品頁
    public function serviceItemPage($service_id) {
        // 撈取商品資料
        $Service = Service::findOrFail($service_id);

        $binding = [
            'title' => '商品服務說明頁',
            'Service' => $Service,
        ];

        return view('service.showService', $binding);
    }

    // 商品購買處理
    public function serviceItemBuyProcess($service_id) {
        //
    }
}
