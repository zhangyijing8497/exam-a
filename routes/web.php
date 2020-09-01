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

// 注册视图
Route::get('/reg','UserController@reg');
// 注册逻辑
Route::post('/reg','UserController@regDo');
// 登录视图
Route::get('/login','UserController@login');
// 登陆逻辑
Route::post('/login','UserController@loginDo');