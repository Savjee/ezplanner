<?php

namespace App\Providers;

use Illuminate\Routing\Route;
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
            URL::forceRootUrl($ingressPath);
            
            Livewire::setUpdateRoute(function ($handle) use ($ingressPath) {
                return Route::post($ingressPath . '/livewire/update', $handle);
            });
        }
    }
}
