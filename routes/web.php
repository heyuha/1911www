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

Route::get('/', function () {
    return view('welcome');
});
Route::get("/test1","TestController@test1");
Route::get("/test2","TestController@test2");


Route::get("/user/login","TestController@login");
Route::get("/user/loginadd","TestController@loginadd");
Route::get("/user/center","TestController@center");
Route::get("/user/reg","TestController@reg");
Route::get("/user/regadd","TestController@regadd");
Route::post("/test/dec",'TestController@dec');
Route::post("/test/dec2",'TestController@dec2');
Route::get("/test/sign",'TestController@sign');//验签
Route::get("/test/sign2",'TestController@sign2');//验签
Route::get("/test/header1",'TestController@header1');


//h5商城执行登录
Route::post("goods/logindo","UserController@logindo");
//注册
Route::post("goods/regdo","UserController@regdo");
Route::get("goods/login_out","UserController@login_out");//退出登录


