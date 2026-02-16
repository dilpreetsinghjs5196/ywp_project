<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        // Share site settings with all views
        if (!app()->runningInConsole() && \Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            $allSettings = \App\Models\SiteSetting::all();
            $settings = $allSettings->pluck('value', 'key');
            view()->share('settings', $settings);

            // Override mail configuration from site settings
            $mailSettings = $allSettings->where('group', 'smtp');
            if ($mailSettings->count() > 0) {
                $mailer = $mailSettings->where('key', 'mail_mailer')->first()->value ?? 'smtp';

                // If the user mistakenly typed the host in the mailer field (common mistake), 
                // we force it to 'smtp' if it contains 'gmail' or 'smtp' but isn't a known driver.
                $validDrivers = ['smtp', 'sendmail', 'mailgun', 'ses', 'postmark', 'log', 'array'];
                if (!in_array($mailer, $validDrivers)) {
                    $mailer = 'smtp';
                }

                config([
                    'mail.default' => $mailer,
                    "mail.mailers.$mailer.host" => $mailSettings->where('key', 'mail_host')->first()->value ?? '',
                    "mail.mailers.$mailer.port" => $mailSettings->where('key', 'mail_port')->first()->value ?? '587',
                    "mail.mailers.$mailer.encryption" => $mailSettings->where('key', 'mail_encryption')->first()->value ?? 'tls',
                    "mail.mailers.$mailer.username" => $mailSettings->where('key', 'mail_username')->first()->value ?? '',
                    "mail.mailers.$mailer.password" => $mailSettings->where('key', 'mail_password')->first()->value ?? '',
                    'mail.from.address' => $mailSettings->where('key', 'mail_from_address')->first()->value ?? config('mail.from.address'),
                    'mail.from.name' => $mailSettings->where('key', 'mail_from_name')->first()->value ?? config('mail.from.name'),
                ]);
            }
        }
    }
}
