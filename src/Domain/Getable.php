<?php

namespace Inoplate\Foundation\Domain;

use InvalidArgumentException;

trait Getable
{
    /**
     * Dynamic property getter
     * 
     * @param  string $property
     * @return mixed
     */
    public function __get($property)
    {
        if( !property_exists($this, $property) ) {
            throw new InvalidArgumentException( "Property [$property] doesn't exist" );
        }

        return $this->{$property};
    }
}