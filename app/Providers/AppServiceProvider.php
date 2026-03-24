<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $publicStorage = public_path('storage');

        if (!file_exists($publicStorage)) {
            app('files')->link(
                storage_path('app/public'),
                $publicStorage
            );
        }
    }
}

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Fuerza HTTPS en Railway
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Storage link automático
        $publicStorage = public_path('storage');
        if (!file_exists($publicStorage)) {
            app('files')->link(
                storage_path('app/public'),
                $publicStorage
            );
        }
    }
}