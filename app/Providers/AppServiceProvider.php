<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $rolePrefix = Auth::check() && Auth::user()->role === 'admin' ? 'admin' : 'tenaga';
            $view->with('rolePrefix', $rolePrefix);
        });
    }
}
