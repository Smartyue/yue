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

/*
|-------------------------------------------------------------
|后台--路由模块
|
|
|
|
|-------------------------------------------------------------
*/
//登录
Route::match(['get','post','put'],'admin/login','Admin\LoginController@login');
Route::group(['middleware'=>['admin'],'prefix'=>'admin'],function (){

    Route::get('/','Admin\IndexController@index');

    Route::get('logout','Admin\LoginController@logout');
});
Route::get('test','TestController@test');