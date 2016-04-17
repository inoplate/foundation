<?php 

namespace Inoplate\Foundation\App\Services\Bus;

use Closure;

interface Dispatcher
{
    /**
     * Dispatch command
     * 
     * @param  DTO              $command
     * @param  Closure|null     $afterResolving
     * @return void
     */
    public function dispatch($command, Closure $afterResolvint);

    /**
     * Register command-to-handler mappings.
     *
     * @param array $commands
     *
     * @return void
     */
    public function maps(array $commands);
}