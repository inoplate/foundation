<?php

namespace Increative\Foundation\Domain\Contracts;

use Increative\Foundation\Domain\Models\Description;

interface Describeable
{   
    /**
     * Retrieve entity's description
     * 
     * @return Description
     */
    public function description();

    /**
     * Describe entity
     * 
     * @param  Description $description
     * @return void
     */
    public function describe(Description $description);
}