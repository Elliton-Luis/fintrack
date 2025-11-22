<?php

namespace App\Providers;

use Inertia\Inertia;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        Inertia::share('auth.user', fn () => auth()->user());
    }
}
