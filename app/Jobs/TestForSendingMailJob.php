<?php

namespace App\Jobs;

use App\Shop\Entity\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;


class TestForSendingMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $TransactionCollection;

    protected $User;
    protected $Transaction;
    /**
     * Create a new job instance.
     *
     * @param  Transaction $TransactionCollection
     * @return void
     */
    public function __construct(Transaction $TransactionCollection)
    {

//        $this->User = $TransactionCollection->User;
        $this->Transaction = $TransactionCollection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $mail_binding = [
            'User' => 'Test',
            'Transaction' => 'Tester',
        ];

        Mail::send(
            'email.SendAutoMailOfAskingForDebt', $mail_binding, function($mail) use ($mail_binding)
        {
            $mail->to('lazzybug0608@gmail.com');
            $mail->from('PayMeChien@gmail.com' );
            $mail->subject('「討債一點靈」貼心提醒');
        });

    }
}
