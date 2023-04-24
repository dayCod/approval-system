<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'page')->name('dashboard.home');
    }); // end route

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('dashboard.user.index');
    }); // end route

});

require __DIR__ . '/auth.php';
