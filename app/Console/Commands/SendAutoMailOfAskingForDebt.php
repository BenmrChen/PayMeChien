<?php

namespace App\Console\Commands;

//require 'vendor/autoload.php';
use App\Shop\Entity\Transaction;
use App\Shop\Entity\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\jobs\SendAutoMailOfAskingForDebtJob;


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

        foreach ($TransactionCollection as $TransactionCollection) {
            SendAutoMailOfAskingForDebtJob::dispatch($TransactionCollection);
        }

    }
}
