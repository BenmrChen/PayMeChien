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
    $time = new Carbon();
    $now = $time->subDays(2);
    $TransactionCollection = Transaction::where('payment_status','F')
    ->where('updated_at', '<', $now )
    ->get();
    dd($TransactionCollection);

//    public function test(){
//        $time = new Carbon;
//        $now = $time->now();
//        dd($time);
//    }
    }
}

