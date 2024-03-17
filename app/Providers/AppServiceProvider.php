<?php

namespace App\Providers;

use App\Interfaces\CrudInterface;
use App\Service\UserService;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind crud interface to user service
        $this->app->bind(CrudInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Redirect default path
//        RedirectIfAuthenticated::redirectUsing(fn ($request) => route('users.index'));
    }
}
