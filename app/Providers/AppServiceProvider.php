<?php

namespace App\Providers;

use App\Services\Auth\Login;
use App\Services\Auth\Logout;
use App\Services\Auth\Register;
use App\Services\Dashboard\Consent\CreateConsent;
use App\Services\Dashboard\Consent\DeleteConsent;
use App\Services\Dashboard\Consent\GetConsent;
use App\Services\Dashboard\Consent\UpdateConsent;
use App\Services\Dashboard\Department\CreateDepartment;
use App\Services\Dashboard\Department\DeleteDepartment;
use App\Services\Dashboard\Department\GetDepartment;
use App\Services\Dashboard\Department\UpdateDepartment;
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

        // Consent
        $this->registerService('getConsent', GetConsent::class);
        $this->registerService('createConsent', CreateConsent::class);
        $this->registerService('updateConsent', UpdateConsent::class);
        $this->registerService('deleteConsent', DeleteConsent::class);

        // Department
        $this->registerService('getDepartment', GetDepartment::class);
        $this->registerService('createDepartment', CreateDepartment::class);
        $this->registerService('updateDepartment', UpdateDepartment::class);
        $this->registerService('deleteDepartment', DeleteDepartment::class);

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
