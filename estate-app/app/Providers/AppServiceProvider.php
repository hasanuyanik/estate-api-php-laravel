<?php

namespace App\Providers;

use App\Contracts\IAppointmentService;
use App\Contracts\IContactService;
use App\Contracts\IUserService;
use App\Http\Services\AppointmentService;
use App\Http\Services\ContactService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\App;
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
        App::bind(IAppointmentService::class, AppointmentService::class);
        App::bind(IContactService::class, ContactService::class);
        App::bind(IUserService::class, UserService::class);
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
}
