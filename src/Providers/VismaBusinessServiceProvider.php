<?php

namespace Apility\Visma\Providers;

use Apility\Visma\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class VismaBusinessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('visma.client', function () {
            return new Client($this->app['config']['visma.url'], $this->app['config']['visma.token'], $this->app['config']['visma.client_id']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $configFile = __DIR__ . '/../resources/config/visma.php';
        
        $this->publishes([
            $configFile => App::configPath('visma.php'),
        ]);

        $this->mergeConfigFrom($configFile, 'visma');

    }
}