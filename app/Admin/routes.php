<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('/about_us', 'AboutUsInfoController');
    $router->resource('/page_settings', 'PageSettingInfoController');
    $router->resource('/news', 'NewsInfoController');
    $router->resource('/customer', 'CustomerInfoController');
    $router->resource('/firm', 'FirmInfoController');
    $router->resource('/accessory', 'AccessoryInfoController');

});
