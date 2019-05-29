<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\Entity\Service;
use App\Shop\Entity\Transaction;
use Exception;
use Session;
use App\Shop\Entity\User;
use Validator;
use DB;
use Mail;

class TransactionController extends Controller {

    public function transactionListPage() {
         $user_id = session()->get('user_id');

         // 每頁資料量
         $row_per_page = 10;
         // 撈取商品分頁資料
         $TransactionPaginate = Transaction::where('user_id', $user_id)
             ->OrderBy('created_at', 'desc')
             ->with('Service') //順便帶Service資料出來
             ->paginate($row_per_page);
//             ->all();

        // 計算要付款的總金額
        $total_amount = 0;
        foreach ($TransactionPaginate as $Transaction) {
            $total_amount = $total_amount + $Transaction->total_price;
        }

        // 把total_amount存入session
        session()->put('total_amount', $total_amount);

        // 判斷是否已付款 並轉成字串
//        $TransactionStatus = Transaction::where('user_id', $user_id)
//            ->OrderBy('created_at', 'desc')
//            ->with('Service') //順便帶Service資料出來
//            ->paginate($row_per_page)
//            ->first();

//        if (isset($TransactionStatus)) {
//            if ($TransactionStatus->payment_status == 'F') {
//                $payment_status = '未付款';
//            } else
//                $payment_status = '已付款';

            $binding = [
                'title' => '交易紀錄',
                'TransactionPaginate' => $TransactionPaginate,
//                'payment_status' => $TransactionStatus->payment_status,
                'total_amount' => $total_amount,
            ];
//        } else {
//            $binding = [
//                'title' => '交易紀錄',
//                'TransactionPaginate' => $TransactionPaginate,
//                'total_amount' => $total_amount,
//            ];
//        }
         return view('transaction.listUserTransaction', $binding);
    }

    public function confirmPayment() {
        if (session()->has('user_id')) {
            $user_id = Session::get('user_id');
            $User = User::where('id', $user_id)->firstOrFail();

            // 每頁資料量
            $row_per_page = 10;
            // 截取還未付款的資料 條件為:1.該名User的交易; 2.還未付款的
            $TransactionPaginate = Transaction::where('user_id', $user_id)
                ->where('payment_status', 'F')
                ->OrderBy('created_at', 'desc')
                ->with('Service') // 把關聯的資料(Service)順便帶出來
                ->paginate($row_per_page);

            // 計算要付款的總金額
            $total_amount = 0;
            foreach ($TransactionPaginate as $Transaction) {
                $total_amount = $total_amount + $Transaction->total_price;
            }

            // 把total_amount存入session
            session()->put('total_amount', $total_amount);

            // 判斷是否已付款 並轉成字串
            $TransactionStatus = Transaction::where('user_id', $user_id)
                ->OrderBy('created_at', 'desc')
                ->with('Service') //順便帶Service資料出來
                ->paginate($row_per_page)
                ->first();
            if (isset($TransactionStatus)) {
                if ($TransactionStatus->payment_status == 'F') {
                    $payment_status = '未付款';
                } else
                    $payment_status = '已付款';

                $binding = [
                    'title' => '付款',
                    'nickname' => $User->username,
                    'TransactionPaginate' => $TransactionPaginate,
                    'total_amount' => $total_amount,
                    'payment_status' => $payment_status,
                ];
            } else {

                $binding = [
                    'title' => '付款',
                    'nickname' => $User->username,
                    'TransactionPaginate' => $TransactionPaginate,
                    'total_amount' => $total_amount,
                ];
            }
            return view('transaction.transactionPayment', $binding);
        }
        else {
            return redirect("/user/auth/sign-in");
        }
    }

    public function confirmPaymentProcess() {
        // 接收輸入資料
        $input = request()->all();

        // 建立驗證規則
        $rules = [
            'payment_number'=>[
                'required',
                'numeric',
                'digits: 5',
            ],
        ];
        // 驗證資料
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            // 資料驗證錯誤
            return redirect('/transaction/payment')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            // 取得登入會員資料
            $user_id = session()->get('user_id');
            $User = User::findOrFail($user_id);
            // 交易開始
            DB::beginTransaction();

            // 取得商品資料
//            $row_per_page = 10;
//            $Transaction = Transaction::where('user_id', $user_id);
//            $TransactionPaginate = Transaction::where('user_id', $user_id)
            $Transaction = Transaction::where('user_id', $user_id)
                ->where('payment_status', 'F')
                ->with('Service')
                ->first(); //若沒有first或get之類的語法 這邊抓出來就會是builders 而不是Transaction這個實例，會這樣是因為我又下了where的語法，讓它以為我還要再下SQL語法
            $Transaction->payment_status='T';
            $Transaction->payment_number=$input['payment_number'];
            $Transaction->save();

            // 交易結束
            DB::commit();

            // 寄送付款完成通知信
            $mail_binding = [
                'nickname' => $User->nickname,
                'total_amount' =>session()->get('total_amount'),
                'service_name' => $Transaction->Service->name,
                'payment_method' => $Transaction->Service->payment_method,
                'payment_number' => $Transaction->payment_number,
                'payment_date' => $Transaction->updated_at,
            ];
//
            Mail::send('email.paymentSuccessEmailNotification', $mail_binding, function ($mail) use ($User) {
                // 收件人
                $mail->to($User->email);
                // 寄件人
                $mail->from('PayMeChien@gmail.com');
                // 郵件主旨
                $mail->subject('恭喜您，已成功付款');
            });

            //回傳訂閱成功訊息
            $message = [
                'msg' => '您已成功付款，感謝您的大恩大德。'
            ];
            return redirect()
                ->to('/transaction')
                ->withErrors($message);


        } catch (Exception $exception) {
            // 恢復原先交易狀態
            DB::RollBack();

            // 回傳錯誤訊息
            $error_message = [
                'msg' => [$exception->getMessage()]
            ];

            return redirect()
                ->back()
                ->withErrors($error_message)
                ->withinput();
        }

    }
}
