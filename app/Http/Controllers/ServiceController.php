<?php

namespace App\Http\Controllers;

use App\Http\Requests\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop\Entity\Service;
use App\Shop\Entity\Transaction;
use App\Shop\Entity\User;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Validator;
use Mail;


class ServiceController extends Controller
{
    // 商品服務清單檢視
    public function serviceListPage()
    {
        // 每頁數量
        $row_per_page = 10;
        // 撈取商品服務分頁資料
        $ServicePaginate = Service::OrderBy('updated_at', 'desc')
            ->where('status', "S")// 販售中
            ->paginate($row_per_page);

        $binding = [
            'title' => '商品服務列表',
            'ServicePaginate' => $ServicePaginate,
        ];

        return view('service.listService', $binding);
    }

    // 服務單品頁
    public function serviceItemPage($service_id)
    {
        // 撈取商品資料
        $Service = Service::findOrFail($service_id);

        $binding = [
            'title' => '商品服務說明頁',
            'Service' => $Service,
        ];

        return view('service.showService', $binding);
    }

    // 商品購買處理
    public function serviceItemBuyProcess($service_id)
    {
//        Log::emergency(request()->all()); 可以用這種方式來紀錄LOG
        // 接收輸入資料
        $input = request()->all();

        // 撈取商品資料
        $Service = Service::findOrFail($service_id);

        // 驗證規則
        $rules = [
            'buy_count' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/service/' . $service_id)
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
            $Service = Service::findOrFail($service_id);
            // 購買數量
            $buy_count = $input['buy_count'];
            // 購買後剩餘數量
            $remain_count_after_buy = $Service->remain_count - $buy_count;
            if ($remain_count_after_buy < 0) {
                // 購買後剩餘數量小於零，不能賣
                throw new Exception('商品數量不足，無法購買');
            }

            // 紀錄購買後剩餘數量
            $Service->remain_count = $remain_count_after_buy; //先指定要更新的欄位
            $Service->save(); //接著在這裡下指令存入

            // 總金額: 總購買數量 * 商品價格 * 6(個月)
            $total_price = $buy_count * $Service->price * 6;

            $transaction_data = [
                'user_id' => $User->id,
                'service_id' => $Service->id,
                'price' => $Service->price,
                'buy_count' => $buy_count,
                'total_price' => $total_price,
            ];
            // 建立交易資料
            Transaction::create($transaction_data);
            // 交易結束
            DB::commit();

            // 寄送交易通知信
            $mail_binding = [
                'nickname' => $User->nickname,
                'service_name' => $Service->name,
                'buy_count' => $buy_count,
                'total_price' => $total_price,
                'payment_period' => $Service->payment_period,
                'payment_method' => $Service->payment_method,
            ];

            Mail::send('email.subscribeSuccessEmailNotification', $mail_binding, function ($mail) use ($User, $Service) {
                // 收件人
                $mail->to($User->email);
                // 寄件人
                $mail->from('PayMeChien@gmail.com');
                // 郵件主旨
                $mail->subject('恭喜您，已成功訂閱「'.$Service->name.'」');
            });


            // 回傳訂閱成功訊息
            $message = [
                'msg' => '恭喜您已訂閱成功! 您將會收到一封確認郵件，請詳閱，謝謝。'
            ];
            return redirect()
                ->to('/service' . '/' . $Service->id)
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

    // 新增服務
    public function serviceCreateProcess() {
        // 建立服務基本資訊
        $service_data= [
          'status'       => 'C', // 服務建立中
          'name'         => '',  // 服務名稱
          'introduction' => '',  // 服務介紹
          'price'        => '0', // 服務價格
          'remain_count' => '0', // 服務剩餘數
          'payment_method' => '轉帳',  // 付款方式
          'payment_period' => '180' // 付款週期
        ];
        $Service = Service::create($service_data); // 在db建資料後專到$Service. 以利下面redirect時取出到URI

        //  重新導向商品編輯頁
        return redirect('/service/'.$Service->id.'/edit');
    }

    // 編輯服務
    public function serviceItemEditPage($service_id) {
        // 撈取服務資料
        $Service = Service::findOrFail($service_id);

        $binding = [
          'title' => '編輯服務內容',
          'Service' => $Service,
        ];

        return view('service.editService', $binding);
    }

    // 服務資料更新處理
    public function serviceItemUpdateProcess($service_id, Test $request) {
        $test = $request->validated(); // 注入 Test 這個 Request
        // 留下被validate的資料
//        $input = request()->all();
//        dd($input);
//        $rules = [
//          'status' => [
//              'required',
//              'in:C,S'
//          ],
//          'name' => [
//              'required',
//          ],
//          'price' => [
//              'required',
//              'integer',
//              'min:0',
//          ],
//          'remain_count' => [
//              'required',
//              'integer',
//              'min:0',
//          ]
//        ];
//        $validator = Validator::make($input, $rules);
//        if ($validator->fails()) {
//            return redirect ('/service/'.$service_id.'/edit')
//                ->withErrors($validator)
//                ->withInput();
//        }

        // input拿進來的array有'_method'和'_token' 得手動移除
//        unset($input['_method']);
//        unset($input['_token']);
        // 不用手動移了 因為用了Request+validate
        Service::where('id', $service_id)->update($test);
        return redirect ('/service/'.$service_id);
    }
}
