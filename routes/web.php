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
//修改个人资料
Route::get('setdata','ShopsController@setdata')->name('setdata');
Route::post('mydata','ShopsController@mydata')->name('mydata');
//菜品分类
Route::resource('menucategories','MenuCategoriesController');
//菜品分类默认
Route::post('default','MenuCategoriesController@default')->name('default');
//菜品
Route::resource('menus','MenusController');
