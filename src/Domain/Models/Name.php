<?php

namespace Increative\Foundation\Domain\Models;

use Increative\Foundation\Domain\Contracts\SpecificationCandidate;

class Name extends ValueObject implements SpecificationCandidate
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}