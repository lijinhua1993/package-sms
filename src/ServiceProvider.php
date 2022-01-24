<?php

namespace Lijinhua\Sms;

use Illuminate\Contracts\Support\DeferrableProvider;
use Lijinhua\Sms\Storage\CacheStorage;
use Overtrue\EasySms\EasySms;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('sms.php'),
            ]);

            $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'sms'
        );

        $this->app->singleton(Sms::class, function ($app) {
            $storage = config('sms.storage', CacheStorage::class);

            return new Sms(new EasySms(config('sms.easy_sms')), new $storage());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [Sms::class];
    }
}