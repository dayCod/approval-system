<?php

use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/'], function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'page')->name('dashboard.home');
    });

});

require __DIR__ . '/auth.php';
