<?php

namespace App\Providers;

use App\Services\Auth\Login;
use App\Services\Auth\Logout;
use App\Services\Auth\Register;
use App\Services\Dashboard\User\CreateUser;
use App\Services\Dashboard\User\DeleteUser;
use App\Services\Dashboard\User\GetUser;
use App\Services\Dashboard\User\UpdateUser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Login
        $this->registerService('authenticate', Login::class);

        // Logout
        $this->registerService('logout', Logout::class);

        // Register
        $this->registerService('register', Register::class);

        // User
        $this->registerService('getUser', GetUser::class);
        $this->registerService('createUser', CreateUser::class);
        $this->registerService('updateUser', UpdateUser::class);
        $this->registerService('deleteUser', DeleteUser::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerService($serviceName, $className) {
        $this->app->singleton($serviceName, function() use ($className) {
            return new $className;
        });
    }
}
