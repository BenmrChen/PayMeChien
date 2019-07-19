<?php

namespace App\Http\Controllers;

//require 'vendor/autoload.php';
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Shop\Entity\Transaction;

class TestController extends Controller
{

    public function test(){
        $input = request()->all();
        dd($input('user_id'));
    $time = new Carbon();
    $now = $time->subDays(2);
    $TransactionCollection = Transaction::where('payment_status','F')
    ->where('updated_at', '<', $now )
    ->get();
//    dd($TransactionCollection);

//    public function test(){
//        $time = new Carbon;
//        $now = $time->now();
//        dd($time);
//    }
    }

    public function testPost(){
        $user_id = request()->all();

        // 每頁資料量
        $row_per_page = 10;
        // 撈取商品分頁資料
        $TransactionPaginate = Transaction::where('user_id', 15)
            ->OrderBy('created_at', 'desc')
            ->with('Service') //順便帶Service資料出來
            ->paginate($row_per_page)
            ->get();
        dd($TransactionPaginate); //有key/value的array

        // 計算要付款的總金額
        $total_amount = 0;
        foreach ($TransactionPaginate as $Transaction) {
            $total_amount = $total_amount + $Transaction->total_price;
        }

        // 把total_amount存入session
        session()->put('total_amount', $total_amount);




        $binding = [
            'title' => '交易紀錄',
            'TransactionPaginate' => $TransactionPaginate,
            'total_amount' => $total_amount,
        ];

        return view('transaction.listUserTransaction', $binding);
    }



}

