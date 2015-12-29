<?php

namespace Increative\Foundation\Domain\Contracts;

interface EntityIdentifierProvider
{   
    /**
     * Retrieve next entity's identity
     * 
     * @return mixed
     */
    public function nextIdentity();
}