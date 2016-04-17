<?php

namespace Inoplate\Foundation\Providers;

use Illuminate\Support\ServiceProvider;

abstract class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * List of commands to register
     * 
     * @var array
     */
    protected $commands = [];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){
        foreach ($this->commands as $command) {
            $this->commands( $command );
        }
    }
}