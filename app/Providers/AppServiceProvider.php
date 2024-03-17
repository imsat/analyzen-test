<?php

namespace App\Providers;

use App\Interfaces\CrudInterface;
use App\Interfaces\TrashInterface;
use App\Service\TrashService;
use App\Service\UserService;
//use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CrudInterface::class, UserService::class);
        $this->app->bind(TrashInterface::class, TrashService::class);
        $this->app->bind( TrashService::class, Container::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
