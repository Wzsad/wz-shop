<?php
/*
 * @Description:
 * @Version: 2.0
 * @Autor: Wz
 * @Date: 2019-04-26 09:12:46
 * @LastEditors  : Wz
 * @LastEditTime : 2020-01-19 15:53:08
 */

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// 必须得验证邮箱的用户才可以访问添加中间件，laravel自带的验证方法添加->middleware('verified')
Route::get('/', 'PagesController@root')->name('root');
Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');
// 商品详情
Route::get('products/{product}', 'ProductsController@show')->name('products.show');
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('user_addresses', 'UserAddressController@index')->name('user_addresses.index');
    // 新增用户地址
    Route::get('user_addresses/create', 'UserAddressController@create')->name('user_addresses.create');
    // 编辑用户地址
    Route::get('user_addresses/{user_address}', 'UserAddressController@edit')->name('user_addresses.edit');
    Route::post('user_addresses', 'UserAddressController@store')->name('user_addresses.store');
    // 更新用户地址
    Route::put('user_addresses/{user_address}', 'UserAddressController@update')->name('user_addresses.update');
    // 删除用户地址
    Route::delete('user_addresses/{user_address}', 'UserAddressController@destory')->name('user_addresses.destory');

});
