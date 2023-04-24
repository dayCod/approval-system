<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {

    Route::controller(LoginController::class)->group(function() {
        Route::get('login', 'page')->name('auth.login-page');
        Route::post('login', 'handleAuthenticate')->name('auth.login');
    }); // end route

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'page')->name('auth.register-page');
    }); // end route

    Route::controller(LogoutController::class)->group(function () {
        Route::get('auth/logout', 'handleLogout')
            ->withoutMiddleware(['guest'])
            ->middleware(['auth'])
            ->name('auth.logout');
    }); // end route

});

