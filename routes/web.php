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
//商家
Route::resource('shops','ShopsController');
Route::get('shows','ShopsController@shows')->name('shows');

//账户
Route::resource('users','UsersController');
//账户登录
Route::get('login','SessionsController@login')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');
//账户登录修改个人密码
Route::get('reset','SessionsController@reset')->name('reset');
Route::post('password','SessionsController@password')->name('password');
