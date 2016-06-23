<?php

namespace Inoplate\Foundation\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Application;

class ServiceViewComposer
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create new NavigationViewComposer instance
     * 
     * @param Request $request
     * @param Application $app
     */
    public function __construct(Request $request, Application $app)
    {
        $this->request = $request;
        $this->app = $app;
    }

    /**
     * Composer navigation view composer
     * 
     * @param  View   $view
     * @return response
     */
    public function compose(View $view)
    {
        $view->with('navigations', $this->app->make('Inoplate\Navigation\Navigation'))
             ->with('widgets', $this->app->make('Inoplate\Widget\Widget'));
    }
}