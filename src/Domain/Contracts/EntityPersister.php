<?php

namespace Increative\Foundation\Domain\Contracts;

interface EntityPersister
{   
    /**
     * Save entity updates
     * 
     * @param  Entity   $entity
     * @return void
     */
    public function save(Entity $entity);

    /**
     * Mark the end of life of entity
     * 
     * @param  Entity   $entity
     * @return void
     */
    public function remove(Entity $entity);
}