<?php

namespace Increative\Foundation\Domain\Contracts;

interface Entity
{   
    /**
     * Retrieve entity's identifier
     * 
     * @return mixed
     */
    public function id();
}