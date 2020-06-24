<?php

namespace Daanra\Ecurring;

use Daanra\Ecurring\Exceptions\EcurringApiKeyMissing;
use Illuminate\Support\ServiceProvider;

class EcurringServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ecurring.php' => config_path('ecurring.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ecurring.php', 'ecurring');

        $config = $this->app->config;

        $this->app->bind('ecurring',function () use ($config) {
            if ($config->get('ecurring.api_key') === null) {
                throw new EcurringApiKeyMissing();
            }

            return new Ecurring(
                new Client($config->get('ecurring.api_key'), $config->get('ecurring.endpoint'))
            );
        });
    }
}
