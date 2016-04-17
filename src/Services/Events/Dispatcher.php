<?php

namespace Inoplate\Foundation\Services\Events;

use Inoplate\Foundation\App\Services\Events\Dispatcher as Contract;
use Illuminate\Contracts\Events\Dispatcher as LaravelDispatcher;

class Dispatcher implements Contract
{
    /**
     * @var Illuminate\Contracts\Event\Dispatcher
     */
    protected $dispatcher;

    /**
     * Create new Dispatcher instance
     * @param Illuminate\Contracts\Event\Dispatcher $dispatcher
     */
    public function __construct(LaravelDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Fire events
     * 
     * @param  array $events
     * @return array
     */
    public function fire($events)
    {
        $return = [];
        foreach ($events as $event) {
            $return[] = $this->dispatcher->fire($event);
        }

        return $return;
    }
}