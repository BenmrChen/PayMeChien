<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendSignUpMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $mail_binding;

    // 建構子
    public function __construct($mail_binding)
    {
        $this->mail_binding = $mail_binding;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    // 執行工作
    public function handle()
    {
        $mail_binding = $this->mail_binding;
        Mail::send(
            'email.signUpEmailNotification',
            $mail_binding,
        function($mail) use ($mail_binding)
    {
        $mail->to($mail_binding['email']);
        $mail->from('PayMeChien@gmail.com');
        $mail->subject('恭喜您，已成功註冊「PayMeChien」');
    });
    }
}

