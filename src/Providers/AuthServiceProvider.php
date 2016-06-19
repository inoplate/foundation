<?php

namespace Inoplate\Foundation\Providers;

use Authis;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        $permissions = $this->registeredPermissions();
        foreach ($permissions as $permission) {
            if(isset($permission['aliases'])) {
                foreach ($permission['aliases'] as $alias) {
                    $this->app['authis']->alias($permission['name'], $alias);
                }
                unset($permission['aliases']);
            }

            if(isset($permission['interceptors'])) {
                foreach($permission['interceptors'] as $interceptor) {
                    $this->app['authis']->intercept($permission['name'], function($user, $ability) use ($interceptor) {
                        return in_array($interceptor, $user->abilities());
                    });
                }

                unset($permission['interceptors']);
            }

            $permission['module'] = $this->moduleName;
            $this->app['permission.store']->register($permission);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}

    /**
     * Register permissions
     * 
     * @return array
     */
    protected function registeredPermissions()
    {
        return [];
    }
}