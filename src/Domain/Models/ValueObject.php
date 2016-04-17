<?php

namespace Inoplate\Foundation\Domain\Models;

abstract class ValueObject
{
    /**
     * Value object value
     * 
     * @var mixed
     */
    protected $value;

    /**
     * Retrieve value object value
     * 
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Determine if value object uqual other
     * 
     * @param  ValueObject $other
     * @return boolean
     */
    public function equal(ValueObject $other)
    {
        return $this == $other;
    }
}