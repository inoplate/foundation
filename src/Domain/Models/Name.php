<?php

namespace Inoplate\Foundation\Domain\Models;

use Inoplate\Foundation\Domain\Contracts\SpecificationCandidate;

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