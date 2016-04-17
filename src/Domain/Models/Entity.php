<?php

namespace Inoplate\Foundation\Domain\Models;

use Inoplate\Foundation\Domain\Contracts\Event;
use Inoplate\Foundation\Domain\Contracts\Entity as EntityContract;

abstract class Entity implements EntityContract, HasEvents
{
    /**
     * Identifier
     * 
     * @var mixed
     */
    protected $id;

    /**
     * @var array
     */
    protected $events = [];

    /**
     * Properties that escaped toArray method
     * 
     * @var array
     */
    protected $toArrayEscapedProperties = ['events'];

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
     * Determine if Entity equal other
     * 
     * @param  Entity $other
     * @return boolean
     */
    public function equal(EntityContract $other)
    {
        return $this == $other;
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

    /**
     * Convert object to array
     * 
     * @return array
     */
    public function toArray()
    {
        $return = [];
        $properties = get_object_vars($this);

        foreach ($properties as $key => $property) {
            if((!in_array($key, $this->toArrayEscapedProperties)) && ($key != 'toArrayEscapedProperties')) {
                if(is_array($property)) {
                    foreach ($property as $key2 => $value) {
                        $return[$key][$key2] = $this->getPropertyValue($value);
                    }
                }else {
                    $return[$key] = $this->getPropertyValue($property);
                }
            }
        }

        return $return;
    }

    protected function getPropertyValue($value)
    {
        if ($value instanceof EntityContract) {
            return $value->toArray();
        }elseif($value instanceof ValueObject) {
            return $value->value();
        }else {
            return $value;
        }
    }
}