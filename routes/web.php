<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::any('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "All Cache is cleared";
});

Route::get('/car_rent', function () {
    return view('car_rent');
})->name('car_rent');

Route::get('/car_rent_s2', function () {
    return view('rv_rent_s2');
})->name('car_rent_s2');

Route::get('/car_rent_s3', function () {
    return view('rv_rent_s3');
})->name('car_rent_s3');

Route::get('/car_rent_s4', function () {
    return view('rv_rent_s4');
})->name('car_rent_s4');

Route::get('/car_rent_s5', function () {
    return view('rv_rent_s5');
})->name('car_rent_s5');
