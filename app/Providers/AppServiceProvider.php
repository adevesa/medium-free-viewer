<?php

namespace App\Providers;

use App\Services\curlService;
use App\Services\curlServiceContract;
use App\Services\testCurlService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(curlServiceContract::class, function ($app) {
            if(app()->environment('testing'))
                return new testCurlService();

            return new curlService();
        });
    }
}
