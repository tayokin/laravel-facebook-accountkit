<?php

declare(strict_types=1);

namespace Tayokin\FacebookAccountKit;

use Illuminate\Support\ServiceProvider;

class FacebookAccountKitServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->publishes([
            \dirname(__DIR__).'/resources/config/accountKit.php' => config_path('accountKit.php'),
        ]);
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            \dirname(__DIR__).'/resources/config/accountKit.php', 'accountKit'
        );
        $this->app->singleton('AccountKit', function () {
            return new FacebookAccountKit();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['AccountKit'];
    }
}
