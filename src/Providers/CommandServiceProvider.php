<?php

namespace Inoplate\Foundation\Providers;

use Inoplate\Foundation\App\Services\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

abstract class CommandServiceProvider extends ServiceProvider
{
    /**
     * List of commands to register
     * 
     * @var array
     */
    protected $commands = [];

    /**
     * Boot command
     * 
     * @param  Dispatcher $dispatcher
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        $dispatcher->maps($this->commands);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}
}