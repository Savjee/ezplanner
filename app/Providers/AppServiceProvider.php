<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        echo "hi";
        dd(request()->headers);
        if ($ingressPath = request()->header('X-Ingress-Path')) {
            $ingressUrl = rtrim(config('app.url'), '/') . $ingressPath;
            URL::forceRootUrl($ingressUrl);
        }
    }
}
