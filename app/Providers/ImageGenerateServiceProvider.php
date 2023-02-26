<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DalleApiService;
class ImageGenerateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton('App\Services\DalleApiService', function ($app) {
            return new DalleApiService($app);
        });
        // $this->app->singleton(ImageGenerateServiceProvider, function ($app) {
        //     return new ImageGenerateServiceProvider($app);
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
