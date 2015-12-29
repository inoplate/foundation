<?php

namespace Increative\Foundation\Domain\Models;

use Increative\Foundation\Domain\Models\Contracts\Event;
use Increative\Foundation\Domain\Models\Contracts\Entity as EntityContract;

abstract class Entity implements EntityContract, HasEvents
{
    /**
     * Identifier
     * @var mixed
     */
    protected $id;

    /**
     * @var array
     */
    protected $events = [];

    /**
     * Each entity should have identifier
     * Retrieve entity's identifier
     * 
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Record an event
     * 
     * @param  Event  $event
     * @return void
     */
    public function recordEvent(Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * Release events
     * 
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}