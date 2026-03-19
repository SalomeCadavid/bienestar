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