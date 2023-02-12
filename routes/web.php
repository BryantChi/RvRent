<?php

use App\Admin\Repositories\AboutUsInfo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Admin\Repositories\PageSettingInfo;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\RvRentController;
// use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Route::get('/about', [AboutUsController::class, 'index'])->name('about');

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

// Route::get('/car_rent', function () {
//     $pageInfo = PageSettingInfo::getBanners('/car_rent');
//     return view('car_rent', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
// })->name('car_rent');
Route::any('/indexModelSearch', [RvRentController::class, 'filterModelsDefault'])->name('IndexModelSearch');

Route::any('car_rent', [RvRentController::class, 'index'])->name('car_rent');

Route::get('/car_rent_s2', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s2', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->middleware(['auth', 'verified'])->name('car_rent_s2');

Route::get('/car_rent_s3', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s3', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->middleware(['auth', 'verified'])->name('car_rent_s3');

Route::get('/car_rent_s4', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s4', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->middleware(['auth', 'verified'])->name('car_rent_s4');

Route::get('/car_rent_s5', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s5', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->middleware(['auth', 'verified'])->name('car_rent_s5');

Route::any('/news', [NewsController::class, 'index'])->name('news');
Route::any('/news/{id}', [NewsController::class, 'show']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::prefix('member_center')->group(function() {
    Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('profile', function () {
            $pageInfo = PageSettingInfo::getBanners('/car_rent');
            return view('member_center.profile', ['title' => '個人資料', 'pageInfo' => $pageInfo, 'user' => Auth::user()]);
        })->name('member.profile');
    });
});
