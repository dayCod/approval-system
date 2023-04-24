<?php

use App\Http\Controllers\Dashboard\ConsentController;
use App\Http\Controllers\Dashboard\DepartmentController;
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

    Route::controller(ConsentController::class)->group(function () {
        Route::get('/consent', 'index')->name('dashboard.consent.index');
    }); // end route

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/department', 'index')->name('dashboard.department.index');
    }); // end route

});

require __DIR__ . '/auth.php';
