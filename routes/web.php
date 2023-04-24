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
        Route::get('/user/create', 'create')->name('dashboard.user.create');
        Route::post('/user/create', 'store')->name('dashboard.user.store');
        Route::get('/user/{id}/edit', 'edit')->name('dashboard.user.edit');
        Route::put('/user/{id}', 'update')->name('dashboard.user.update');
        Route::delete('/user/{id}/destroy', 'destroy')->name('dashboard.user.destroy');
    }); // end route

    Route::controller(ConsentController::class)->group(function () {
        Route::get('/consent', 'index')->name('dashboard.consent.index');
        Route::get('/consent/create', 'create')->name('dashboard.consent.create');
        Route::post('/consent/create', 'store')->name('dashboard.consent.store');
        Route::get('/consent/{id}/edit', 'edit')->name('dashboard.consent.edit');
        Route::put('/consent/{id}', 'update')->name('dashboard.consent.update');
        Route::delete('/consent/{id}/destroy', 'destroy')->name('dashboard.consent.destroy');
    }); // end route

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/department', 'index')->name('dashboard.department.index');
        Route::get('/department/create', 'create')->name('dashboard.department.create');
        Route::post('/department/create', 'store')->name('dashboard.department.store');
        Route::get('/department/{id}/edit', 'edit')->name('dashboard.department.edit');
        Route::put('/department/{id}', 'update')->name('dashboard.department.update');
        Route::delete('/department/{id}/destroy', 'destroy')->name('dashboard.department.destroy');
    }); // end route

});

require __DIR__ . '/auth.php';
