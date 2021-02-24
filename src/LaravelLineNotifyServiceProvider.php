<?php

declare(strict_types=1);
/**
 * This file is part of laravel-line-notify.
 *
 * @link     https://github.com/fcorz/laravel-line-notify
 * @document https://github.com/fcorz/laravel-line-notify/blob/master/README.md
 * @contact  fengchenorz@gmail.com
 */
namespace Fcorz\LaravelLineNotify;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class LaravelLineNotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('line.php'),
            ], 'config');
        }

        $this->app->make(ChannelManager::class)->extend('line', function ($app) {
            return $app->make(LaravelLineNotifyChannel::class);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'line.php');

        // Register the main class to use with the facade
        $this->app->singleton('line-notify', function () {
            return new LaravelLineNotify();
        });
    }
}
