<?php

namespace App\Console\Commands;

//require 'vendor/autoload.php';
use App\Shop\Entity\Transaction;
use App\Shop\Entity\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\SendAutoMailOfAskingForDebtJob;


class SendAutoMailOfAskingForDebt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // 指令名稱
    protected $signature = 'shop:sendAutoMailOfAskingForDebt';

    /**
     * The console command description.
     *
     * @var string
     */
    // 指令描述
    protected $description = '[郵件]寄送討債郵件';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    // 執行工作
    public function handle() {
        $time = new Carbon();
        $standardTime = $time->subDays(5); // 規則: 訂閱後5天內要付款
        $TransactionCollection = Transaction::where('payment_status', 'F')
            ->where('created_at', '<', $standardTime) // 條件: 把"今天減5天"和"訂閱日期"相比，若訂則日小於今天-5，則代表已經過了5天卻還沒付款
            ->with('User')
            ->get();
//        dd($TransactionCollection[0]->User);
//        foreach ($TransactionCollection as $TransactionCollectionA) {
//            $user_id =$TransactionCollectionA->user_id;
//            dd($user_id);
//        }
//        $user_id = $TransactionCollection[0]->user_id;
//        $UserCollection = User::where('id', $user_id);
//        $TransactionCollection = Transaction::first();
//        SendAutoMailOfAskingForDebtJob::dispatch($TransactionCollection);
//        dd('123');
        foreach ($TransactionCollection as $TransactionCollectionNew) {
            SendAutoMailOfAskingForDebtJob::dispatch($TransactionCollectionNew);
        }

    }
}
