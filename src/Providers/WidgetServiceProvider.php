<?php

namespace Inoplate\Foundation\Providers;

use Widget;
use Illuminate\Support\ServiceProvider;

abstract class WidgetServiceProvider extends ServiceProvider
{
    /**
     * List of widgets to register
     * 
     * @var array
     */
    protected $widgets = [];

    /**
     * Boot widget
     * 
     * @return void
     */
    public function boot()
    {
        foreach ($this->widgets as $key => $handlers) {
            foreach ($handlers as $handler) {
                Widget::register($key, $handler);
            }             
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}
}