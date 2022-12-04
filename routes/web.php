<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Admin\Repositories\PageSettingInfo;
use Illuminate\Support\Facades\Artisan;

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

// Route::get('/', function () {
//     return view('index');
// })->name('index');

Route::any('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    // return "All Cache is cleared";
    // $pageInfo = PageSettingInfo::getHomeBanner('/index');
    // return view('index', ['pageInfo' => $pageInfo]);
    return redirect()->route('index');
});

// Route::resource('/', 'App\Http\Controllers\IndexController');
Route::any('/', [IndexController::class, 'index'])->name('index');

Route::get('/car_rent', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('car_rent', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->name('car_rent');

Route::get('/car_rent_s2', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s2', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->name('car_rent_s2');

Route::get('/car_rent_s3', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s3', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->name('car_rent_s3');

Route::get('/car_rent_s4', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s4', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->name('car_rent_s4');

Route::get('/car_rent_s5', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s5', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->name('car_rent_s5');

Route::any('/news', [NewsController::class, 'index'])->name('news');
Route::any('/news/{id}', [NewsController::class, 'show']);
