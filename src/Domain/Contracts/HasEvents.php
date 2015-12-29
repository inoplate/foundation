<?php

namespace Increative\Foundation\Domain\Contracts;

interface HasEvents
{   
    /**
     * Record an event
     * 
     * @param  Event  $event
     * @return void
     */
    public function recordEvent(Event $event);

    /**
     * Release events
     * 
     * @return array
     */
    public function releaseEvents();
}