<?php

namespace Inoplate\Foundation\Providers;

use Authis;
use Illuminate\Support\ServiceProvider;
use Inoplate\Account\Services\Permission\Collector as PermissionCollector;

abstract class AuthServiceProvider extends ServiceProvider
{
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
            $collector->collect($key, $val);
        }

        $permissionsAliases = $this->registerPermissionsAliases();

        foreach ($permissionsAliases as $permision => $aliases) {
            foreach ($aliases as $alias) {
                $this->app['authis']->alias($permision, $alias);
            }
        }

        $permisionsOverrideInterceptors = $this->registerPermissionsOverrideInterceptors();

        foreach ($permisionsOverrideInterceptors as $key => $value) {
            $this->app['authis']->intercept($key, function($user, $alias) use ($value) {

                return $user->check($value);

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