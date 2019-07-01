<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/index_2', function () {
    return view('index_2');
});

Route::get('/test','testController@test');
Route::post('/test','testController@testPost');

Route::get('/index', function () {
    return view('index');
});
// 首頁
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'user'], function () {
    // User 驗證
    Route::group(['prefix' => 'auth'], function () {
        // User 註冊頁面
        Route::get('/sign-up', 'UserAuthController@signUpPage');

        // User 註冊資料處理
        Route::post('/sign-up', 'UserAuthController@signUpProcess');

        // User 登入頁面
        Route::get('/sign-in', 'UserAuthController@signInPage');

        // User 登入處理
        Route::post('/sign-in', 'UserAuthController@signInProcess');

        // User 登出
        Route::get('/sign-out', 'UserAuthController@signOut');
    });

    // User 個資相關
    Route::group(['prefix' => 'profile'], function () {
        // User 個資檢視
        Route::get('/read', "UserProfileController@readProfile");

        // User 個資修改
        Route::get('/modify', "UserProfileController@modifyProfile");
    });
});

// 商品服務
Route::group(['prefix' => 'service'], function () {
    // 服務清單檢視
    Route::get('/', "ServiceController@serviceListPage");

    // 新增商品服務
    Route::get('/create', "ServiceController@serviceCreateProcess")
    ->middleware(['user.auth.admin']);

    // 服務管理清單檢視
    Route::get('/manage', "ServiceController@serviceManageListPage")
    ->middleware(['user.auth.admin']);

    // 指定商品服務
    Route::group(['prefix' => '{service_id}'], function(){
       // 單品檢視
       Route::get('/', "ServiceController@serviceItemPage");

       // 購買服務單品
       Route::post('/buy', "ServiceController@serviceItemBuyProcess");

       // 服務單品編輯頁面檢視
       Route::get('/edit', "ServiceController@serviceItemEditPage")
        ->middleware(['user.auth.admin']);

       // 服務單品資料修改
       Route::put('/', "ServiceController@serviceItemUpdateProcess")
        ->middleware(['user.auth.admin']);
    });
});

// 交易資料
Route::get('/transaction', 'TransactionController@transactionListPage');

// 付款確認
Route::get('/transaction/payment', 'TransactionController@confirmPayment');

Route::get('/transaction/payment/process', 'TransactionController@confirmPaymentProcess');
