<?php

namespace Increative\Foundation\Domain\Models;

abstract class ValueObject
{
    /**
     * Determine if value object uqual other
     * 
     * @param  ValueObject $other
     * @return boolean
     */
    public function equal(ValueObject $other)
    {
        return $this === $other;
    }
}