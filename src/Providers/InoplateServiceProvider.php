<?php

namespace Inoplate\Foundation\Providers;

use Illuminate\Routing\Router;

class InoplateServiceProvider extends AppServiceProvider
{
    /**
     * Boot package
     * 
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadTranslation();
        $this->loadView();
        $this->loadConfiguration();
        $this->mapRoutes($router);

        view()->composer(
            ['inoplate-foundation::partials.sidebar', 'inoplate-foundation::partials.content-header'], 
            'Inoplate\Foundation\Http\ViewComposers\NavigationViewComposer'
        );
    }

    /**
     * Register the authenticator services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->singleton('Inoplate\Foundation\App\Services\Bus\Dispatcher', 'Inoplate\Foundation\Services\Bus\Dispatcher');
        $this->app->singleton('Inoplate\Foundation\App\Services\Events\Dispatcher', 'Inoplate\Foundation\Services\Events\Dispatcher');
    }

    /**
     * Load packages's translation
     * 
     * @return void
     */
    protected function loadTranslation()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'inoplate-foundation');
    }

    /**
     * Load package's views
     * 
     * @return void
     */
    protected function loadView()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'inoplate-foundation');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/inoplate-foundation'),
        ], 'views');
    }

    /**
     * Load package configuration
     * 
     * @return void
     */
    protected function loadConfiguration()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/foundation.php', 'inoplate.foundation'
        );

        $this->publishes([
            __DIR__.'/../../config/foundation.php' => config_path('inoplate/foundation.php'),
        ], 'config');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function mapRoutes(Router $router)
    {
        $router->group(['namespace' => 'Inoplate\Foundation\Http\Controllers', 'middleware' => ['web']], function ($router) {

            require __DIR__.'/../Http/routes.php';

        });
    }

}