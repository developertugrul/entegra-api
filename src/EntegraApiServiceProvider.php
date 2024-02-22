<?php

namespace Developertugrul\EntegraApi;

use Illuminate\Support\ServiceProvider;
use Developertugrul\EntegraApi\EntegraApi;

class EntegraApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EntegraApi::class, function ($app) {
            return new EntegraApi();
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
