<?php

namespace App\Providers;

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
        // Share site settings with all views
        if (!app()->runningInConsole() && \Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
            view()->share('settings', $settings);
        }
    }
}
