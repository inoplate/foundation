<?php

namespace Increative\Foundation\Domain\Models;

trait Describeable
{
    /**
     * @var Description
     */
    protected $description;

    /**
     * Retrieve entity's description
     * 
     * @return Description
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * Describe entity
     * 
     * @param  Description $description
     * @return void
     */
    public function describe(Description $description)
    {
        if(!$this->description->equal($description)) {
            $this->description = $description;
        }
    }
}