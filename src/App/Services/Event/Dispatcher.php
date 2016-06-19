<?php

namespace Inoplate\Foundation\App\Services\Event;

interface Dispatcher
{
    /**
     * Fire events
     * 
     * @param  array $events
     * @return mixed
     */
    public function fire($events);
}