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
// 必须得验证邮箱的用户才可以访问添加中间件，laravel自带的验证方法添加->middleware('verified')
Route::get('/', 'PagesController@root')->name('root');

Auth::routes(['verify'=>true]);

