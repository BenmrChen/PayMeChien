<?php

namespace App\Http\Controllers;

use App\Jobs\SendSignUpMailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use App\Shop\Entity\User;
use Mail;
use App\Shop\Entity\Transaction;


class UserAuthController extends Controller {
    // 註冊頁
    public function signUpPage(){
        $binding = [
            'title' => '註冊',
        ];

        return view('auth.signUp', $binding);
    }

    // 處理註冊資料
    public function signUpProcess()
    {
        // 接收輸入資料
        $input = request()->all();
        // 建立驗證規則
        $rules = [
        //  暱稱
            'nickname'=>[
                'required',
                'max:50',
            ],
         // Email
            'email'=>[
                'required',
                'max:150',
                'email',
                'unique:users,email'
            ],
        // 密碼
            'password'=>[
                'required',
                'same:password_confirmation',
                'min:6',
            ],
        // 確認密碼
            'password_confirmation'=>[
                'required',
                'min:6',
            ],
        // 帳號類型
            'type'=>[
                'required',
                'in:G,A',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            // 資料驗證錯誤
            return redirect('/user/auth/sign-up')
                ->withErrors($validator)
                ->withInput();
        }

        // 密碼加密
        $input['password'] = Hash::make($input['password']);

        // 新增會員資料
        User::create($input);

        // 寄送註冊通知信
        $mail_binding = [
          'nickname' => $input['nickname'],
          'email' => $input['email'],
        ];

        // 派發註冊成功job
        SendSignUpMailJob::dispatch($mail_binding);

//        Mail::send('email.signUpEmailNotification', $mail_binding, function($mail) use ($input){
//          // 收件人
//          $mail->to($input['email']);
//          // 寄件人
//          $mail->from('PayMeChien@gmail.com');
//          // 郵件主旨
//          $mail->subject('恭喜您，已成功註冊「PayMeChien」');
//        });
        $message = [
            'msg' => '恭喜您已成功註冊! 您將會收到一封確認郵件，謝謝。'];
        //重新導向到登入頁
        return redirect('/user/auth/sign-in')
            ->withErrors($message);
    }

    // 登入
    public function signInPage(){
        $binding = [
            'title' => '登入',
        ];
        Return view('auth.signIn', $binding);
    }

    // 處理登入資料
    public function signInProcess(){
        $input = request()->All();

        $rules = [
            'email' =>[
                'required',
                'max:150',
                'email',
            ],
            'password' =>[
                'required',
                'min:6',
            ],
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect('/user/auth/sign-in')
                ->withErrors($validator)
                ->withInput();
        }

        $User = User::where('email', $input['email'])->first();

        if (!isset($User)) {
            $error_message = [
                'msg' =>
                    '帳號或密碼錯誤',
            ];
            return redirect('/user/auth/sign-in')
                ->withErrors($error_message)
                ->withInput();
        }

        $is_password_correct = Hash::check($input['password'], $User->password);

        if (!$is_password_correct) {
         $error_message = [
             'msg'=> [
                 '密碼驗證錯誤',
             ],
         ];
         return redirect('/user/auth/sign-in')
             ->withErrors($error_message)
             ->withInput();
        }

        // session 紀錄會員編號
        session()->put('user_id', $User->id);

        // 若User有買東西還沒付款 則導向付款頁面; 否則重新導向到原先使用者造訪頁面，若無，則導回首頁
        $Transaction = Transaction::where('user_id', $User->id)
                                    ->where('payment_status', 'F')
                                    ->first();
        if (isset($Transaction->id)) {
            return redirect("/transaction/payment");
        }
        return redirect()->intended('/');
    }

    // 處理登出資料
    public function signOut(){
        // 清除 session
        session()->forget('user_id');

        // 重新導向回首頁
        return redirect('/');
    }
}
