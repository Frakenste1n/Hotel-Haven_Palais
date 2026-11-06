<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        Blade::if('allows', function (string ...$permissions): bool {
            return auth()->user()?->allows(...$permissions) ?? false;
        });

        View::composer(['backend.*', 'frontend.*'], function ($view) {
            $view->with('site', Setting::current() ?? new Setting());
        });

        View::composer('backend.*', function ($view) {
            if (auth()->check()) {
                auth()->user()->loadMissing('roles');
            }
        });
    }
}
