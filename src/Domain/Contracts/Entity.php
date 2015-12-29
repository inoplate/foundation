<?php

namespace Inoplate\Foundation\Domain\Contracts;

interface Entity
{   
    /**
     * Retrieve entity's identifier
     * 
     * @return mixed
     */
    public function id();
}