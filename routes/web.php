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

Route::group(['middleware' => ['auth', 'verified']], function(){
	Route::get('user_addresses', 'UserAddressController@index')->name('user_addresses.index');
	// 新增用户地址
	Route::get('user_addresses/create', 'UserAddressController@create')->name('user_addresses.create');
	// 编辑用户地址
	Route::get('user_addresses/{user_address}','UserAddressController@edit')->name('user_addresses.edit');
	Route::post('user_addresses', 'UserAddressController@store')->name('user_addresses.store');
	// 更新用户地址
	Route::put('user_addresses/{user_address}', 'UserAddressController@update')->name('user_addresses.update');
	// 删除用户地址
	Route::delete('user_addresses/{user_address}', 'UserAddressController@destory')->name('user_addresses.destory');
});