<?php

use App\Admin\Controllers\RvVehicleInfoController;
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
    $router->resource('/recommended_itinerary', 'RecommendedItineraryInfoController');
    $router->resource('/rent_witness', 'RentWitnessController');
    $router->resource('/rv_series', 'RvSeriesInfoController');
    $router->resource('/rv_model', 'RvModelInfoController');
    $router->resource('/rv_attachment', 'RvAttachmentInfoController');
    $router->resource('/rv_vehicle', 'RvVehicleInfoController');
    $router->resource('/rv_order', 'RentOrderInfoController');
    $router->resource('/rv_date_lock', 'RvDateLockInfoController');

});
