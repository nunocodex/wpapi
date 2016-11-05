<?php

namespace NunoPress\WpApi\Providers;

use Illuminate\Support\ServiceProvider;
use NunoPress\WpApi\WpApi;
use NunoPress\WpApi\WpApiClient;

/**
 * Class LaravelServiceProvider
 *
 * @package NunoPress\WpApi\Providers
 */
class LaravelServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../laravel/resources/config/wpapi.php' => config_path('wpapi.php')
        ], 'config');
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../laravel/resources/config/wpapi.php', 'wpapi');

        $this->app->bind('wpapi', function () {
            return new WpApi(
                new WpApiClient(
                    config('wpapi.client.options', [])
                )
            );
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'wpapi'
        ];
    }


}
