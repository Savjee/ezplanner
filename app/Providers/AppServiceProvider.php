<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        if ($ingressPath = request()->header('X-Ingress-Path')) {
            // URL::forceRootUrl($ingressPath);
            
            Config::set('app.url', $ingressPath);
            Config::set('app.asset_url', $ingressPath);

            // Livewire::setUpdateRoute(function ($handle) use ($ingressPath) {
            //     return Route::post($ingressPath . '/livewire/update', $handle);
            // });
        }
    }
}
