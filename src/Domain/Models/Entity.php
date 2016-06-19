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
     * @param  int $deep
     * @return array
     */
    public function toArray($deep = 1)
    {
        $return = [];
        $properties = get_object_vars($this);

        foreach ($properties as $key => $property) {
            if((!in_array($key, $this->toArrayEscapedProperties)) && ($key != 'toArrayEscapedProperties')) {
                if(is_array($property)) {
                    $return[$key] = [];
                    foreach ($property as $key2 => $value) {
                        $prop = $this->getPropertyValue($value, $deep);
                        if( !$prop instanceof UnsetThisValue) {
                            $return[$key][$key2] = $prop;
                        }else {
                            unset($return[$key][$key2]);
                        }
                    }
                }else {
                    $prop = $this->getPropertyValue($property, $deep);

                    if( !$prop instanceof UnsetThisValue) {
                        $return[$key] = $prop;    
                    }else{
                        unset($return[$key]);
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Retrieve property value
     * 
     * @param  mixed $value
     * @param  int $deep
     * @return mixed
     */
    protected function getPropertyValue($value, $deep)
    {
        if ($value instanceof EntityContract) {
            if($deep > 0) {
                return $value->toArray($deep - 1);
            }else {
                return new UnsetThisValue;
            }
        }elseif($value instanceof ValueObject) {
            return $value->value();
        }else {
            return $value;
        }
    }
}