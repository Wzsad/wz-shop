<?php
/*
 * @Description:
 * @Version: 2.0
 * @Autor: Wz
 * @Date: 2019-04-26 09:12:46
 * @LastEditors: Wz
 * @LastEditTime: 2020-01-19 16:15:56
 */

use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::registerAuthRoutes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('users', 'UserController@index');
    $router->get('products', 'ProductsController@index');
    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');
    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');
});
