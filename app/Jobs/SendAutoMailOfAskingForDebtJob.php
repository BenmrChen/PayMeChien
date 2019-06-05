<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendAutoMailOfAskingForDebtJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $TransactionCollection;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($TransactionCollection)
    {
        $this->User = $TransactionCollection->user;
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
            'User' => $this->User,
            'Transaction' => $this->Transaction,
        ];

        Mail::send(
            'email.SendAutoMailOfAskingForDebt', $mail_binding, function($mail) use ($mail_binding)
        {
            $mail->to($mail_binding['User']->email);
            $mail->from('PayMeChien@gmail.com' );
            $mail->subject('「討債一點靈」貼心提醒');
        });

    }
}
