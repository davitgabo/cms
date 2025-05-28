<?php

namespace App\Providers;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the custom JavaScript file with Filament
        FilamentAsset::register([
            Js::make('file-manager-listener', __DIR__ . '/../../resources/js/file-manager-listener.js'),
        ]);
    }
}
