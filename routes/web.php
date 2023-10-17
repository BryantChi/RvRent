<?php

use App\Admin\Repositories\AboutUsInfo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Admin\Repositories\PageSettingInfo;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RvRentController;
use Illuminate\Support\Facades\Artisan;
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
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    // return "All Cache is cleared";
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
Route::any('/indexSpecialSearch', [RvRentController::class, 'getSpecialDaysPlan'])->name('IndexSpecialSearch');

Route::any('car_rent', [RvRentController::class, 'index'])->name('car_rent');

Route::any('/Rv_Detail/{id}', [RvRentController::class, 'show'])->name('Rv_Detail');

Route::any('/remove-carrent-cookie', [RvRentController::class, 'removeCarRentCookie'])->name('remove-carrent-cookie');
Route::any('/car_rent_s2/{rvm_id}/{spid?}', [RvRentController::class, 'stepOneShow'])->name('car_rent_s2');
// ->middleware(['auth', 'verified'])
Route::any('/car_rent_s3/{rvm_id}', [RvRentController::class, 'showStepTwo'])->name('car_rent_s3')->middleware(['auth']);

Route::any('/car_rent_s4', [RvRentController::class, 'showStepThree'])->name('car_rent_s4')->middleware(['auth']);

Route::get('/car_rent_s5', function () {
    $pageInfo = PageSettingInfo::getBanners('/car_rent');
    return view('rv_rent_s5', ['title' => '即刻租車', 'pageInfo' => $pageInfo]);
})->name('car_rent_s5')->middleware(['auth', 'verified']);

Route::any('/news', [NewsController::class, 'index'])->name('news');
Route::any('/news/{id}', [NewsController::class, 'show']);

Route::any('rent_witness', function () {
    $pageInfo = PageSettingInfo::getBanners('/rent_witness');
    return view('rent_witness', ['title' => '租車見證', 'pageInfo' => $pageInfo]);
})->name('rent_witness');

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::prefix('member_center')->group(function() {
    Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('profile', function () {
            $pageInfo = PageSettingInfo::getBanners('/member_center/profile');
            return view('member_center.profile', ['title' => '個人資料', 'pageInfo' => $pageInfo, 'user' => Auth::user()]);
        })->name('member.profile');
        Route::any('profile/{user}', [ProfileController::class, 'update'])->name('member.profile.update');

        Route::any('order', [OrderController::class, 'index'])->name('member.order');
        Route::any('order/{id}', [OrderController::class, 'destroy'])->name('member.order.delete');
        Route::any('order/{id}/upload-remit', [OrderController::class, 'uploadRemit'])->name('member.order.upload-remit');
    });
});
