<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {

    Route::controller(LoginController::class)->group(function() {
        Route::get('login', 'page')->name('auth.login-page');
    }); // end route

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'page')->name('auth.register-page');
    });

});
