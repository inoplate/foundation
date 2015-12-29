<?php

namespace Increative\Foundation\Domain\Contracts;

interface Specification
{
    /**
     * Determine if specification is satisfied by candidate
     * 
     * @param  SpecificationCandidate $candidate
     * @return boolean
     */
    public function isSatisfiedBy(SpecificationCandidate $candidate);
}