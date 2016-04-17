<?php

namespace Inoplate\Foundation\Providers;

use Illuminate\Support\ServiceProvider;

abstract class AppServiceProvider extends ServiceProvider
{
    /**
     * List of providers to register
     * 
     * @var array
     */
    protected $providers = [];

    /**
     * Register the authenticator services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}