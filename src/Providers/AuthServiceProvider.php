<?php

namespace Inoplate\Foundation\Providers;

use Authis;
use Illuminate\Support\ServiceProvider;
use Inoplate\Account\Services\Permission\Collector as PermissionCollector;

abstract class AuthServiceProvider extends ServiceProvider
{
    /**
     * Module name to register
     * 
     * @var string
     */
    protected $moduleName = '';

    /**
     * Boot Auth
     * 
     * @param  Inoplate\Services\Permission\Collector $collector
     * @return void
     */
    public function boot(PermissionCollector $collector)
    {
        $permissions = $this->registerPermissions();

        foreach ($permissions as $key => $val) {
            $collector->collect($key, $val, $this->moduleName);
        }

        $permissionsAliases = $this->registerPermissionsAliases();

        foreach ($permissionsAliases as $permision => $aliases) {
            foreach ($aliases as $alias) {
                $this->app['authis']->alias($permision, $alias);
            }
        }

        $permisionsOverrideInterceptors = $this->registerPermissionsOverrideInterceptors();

        foreach ($permisionsOverrideInterceptors as $key => $value) {
            $this->app['authis']->intercept($key, function($user, $ability) use ($value) {
                return in_array($value, $user->abilities());
            });
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}

    /**
     * Register permisions
     * 
     * @return array
     */
    protected function registerPermissions()
    {
        return [];
    }

    /**
     * Register permissions aliases
     * 
     * @return array
     */
    protected function registerPermissionsAliases()
    {
        return [];
    }

    /**
     * Register permissions overrides interceptors
     * 
     * @return array
     */
    protected function registerPermissionsOverrideInterceptors()
    {
        return [];
    }
}