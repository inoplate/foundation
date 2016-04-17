<?php

namespace Inoplate\Foundation\App\Services\Events;

interface Dispatcher
{
    /**
     * Fire events
     * 
     * @param  array $events
     * @return array
     */
    public function fire($events);
}