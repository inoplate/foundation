<?php

namespace Inoplate\Foundation\Providers;

use Illuminate\Routing\Router;
use Assets;
use Blade;

class InoplateServiceProvider extends AppServiceProvider
{
    /**
     * List of providers to register
     * 
     * @var array
     */
    protected $providers = [
        \Stolz\Assets\Laravel\ServiceProvider::class,
        \AltThree\Bus\BusServiceProvider::class,
        \Roseffendi\Authis\Laravel\AuthisServiceProvider::class,
        \Roseffendi\Dales\Laravel\DalesServiceProvider::class,
        \Inoplate\Notifier\Laravel\NotifierServiceProvider::class,
        \Inoplate\Adminutes\AdminutesServiceProvider::class,
        \Inoplate\Widget\WidgetServiceProvider::class,
        \Inoplate\Navigation\NavigationServiceProvider::class,
        \Inoplate\Captcha\CaptchaServiceProvider::class,
    ];

    /**
     * Boot package
     * 
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadPublic();
        $this->loadTranslation();
        $this->loadView();
        $this->loadConfiguration();
        $this->mapRoutes($router);
        $this->reconfigureAsset();
        $this->registerBladeAssetDirective();
        $this->loadDefaultAsset();

        view()->composer(
            ['inoplate-foundation::partials.sidebar', 'inoplate-foundation::partials.content-header'], 
            'Inoplate\Foundation\Http\ViewComposers\NavigationViewComposer'
        );

        view()->composer(
            '*',
            'Inoplate\Foundation\Http\ViewComposers\ServiceViewComposer'
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
     * Load default assets
     * 
     * @return void
     */
    protected function loadDefaultAsset()
    {
        if(!$this->app['request']->ajax()) {
            Assets::add('default_non_ajax');
        }
    }

    /**
     * Reconfigure asset
     * 
     * @return void
     */
    protected function reconfigureAsset()
    {
        $configuredAssetConfig = $this->app['config']->get('assets', []);
        $foundationAssetConfig = $this->app['config']->get('inoplate.foundation.assets', []);
        $assetConfig = array_merge_recursive($configuredAssetConfig, $foundationAssetConfig);

        Assets::config($assetConfig);
    }

    /**
     * Register blade asset directive
     * 
     * @return void
     */
    protected function registerBladeAssetDirective()
    {
        Blade::directive('addAsset', function($expression){
            return "<?php Assets::add($expression) ?>";
        });

        Blade::directive('addCss', function($expression){
            return "<?php Assets::addCss($expression) ?>";
        });

        Blade::directive('addJs', function($expression){
            return "<?php Assets::addJs($expression) ?>";
        });

        Blade::directive('css', function(){
            return "<?php echo Assets::css() ?>";
        });

        Blade::directive('js', function(){
            return "<?php echo Assets::js() ?>";
        });
    }

    /**
     * Publish public assets
     * @return void
     */
    protected function loadPublic()
    {
        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/inoplate-foundation'),
        ], 'public');
    }

    /**
     * Load packages's translation
     * 
     * @return void
     */
    protected function loadTranslation()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'inoplate-foundation');

        $this->publishes([
            __DIR__.'/../../resources/lang' => base_path('resources/lang/vendor/inoplate-foundation'),
        ], 'lang');
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