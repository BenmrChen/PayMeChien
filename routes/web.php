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
// 首頁
Route::get('/', function () {
    return view('welcome');
});
    Route::group(['prefix' =>'user'], function(){
        // User 驗證
        Route::group(['prefix' => 'auth'], function(){
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
        Route::group(['prefix' => 'profile'], function(){
            // User 個資檢視
            Route::get('/read', "UserProfileController@readProfile");

            // User 個資修改
            Route::get('/modify', "UserProfileController@modifyProfile");
        });
    });
