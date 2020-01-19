<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

// 定义一个版本分组，这种定义方式有利于后续为相同端点新增版本支持
// 一个分组返回多个版本，只需要传递一个版本数组['v1','v2']
// 通过在第二个参数上传递一个属性数组，你也可以将此组视为特定框架的标准组
$api->version('v1', function ($api) {
    /*$api->group(['middleware' => 'foo'], function ($api) {
        // Endpoints registered here will have the "foo" middleware applied.
    });*/
    // $api->get('users/{id}', 'App\Api\Controllers\UserController@show');
    $api->post('test', 'App\Api\Controllers\TestController@index');
    $api->post('keytest', 'App\Api\Controllers\TestController@indexkey');
    $api->get('json', 'App\Api\Controllers\TestController@apitest');
});
