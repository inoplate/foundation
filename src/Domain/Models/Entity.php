<?php

namespace Inoplate\Foundation\Domain\Models;

use Inoplate\Foundation\Domain\Contracts\Event;
use Inoplate\Foundation\Domain\Contracts\Entity as EntityContract;

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