<?php

namespace Inoplate\Foundation\Services\Bus;

use Closure;
use Inoplate\Foundation\App\Services\Bus\Dispatcher as Contract;
use Inoplate\Foundation\App\Services\Bus\ShouldBeQueued;
use AltThree\Bus\Dispatcher as AltDispatcher;

class Dispatcher implements Contract
{
    /**
     * @var AltThree\Bus\Dispatcher
     */
    protected $dispatcher;

    /**
     * Create new Dispatcher instance
     * 
     * @param AltDispatcher $dispatcher
     */
    public function __construct(AltDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Dispatch command
     * 
     * @param  DTO              $command
     * @param  Closure|null     $afterResolving
     * @return void
     */
    public function dispatch($command, Closure $afterResolving = null)
    {
        if($this->commandShouldBeQueued($command)) {
            $this->dispatcher->dispatchToQueue($command);
        }else {
            $this->dispatcher->dispatchNow($command, $afterResolving);
        }
    }

    /**
     * Register command-to-handler mappings.
     *
     * @param array $commands
     *
     * @return void
     */
    public function maps(array $commands)
    {
        $this->dispatcher->maps($commands);
    }

    /**
     * Determine if the given command should be queued.
     *
     * @param  mixed  $command
     * @return bool
     */
    protected function commandShouldBeQueued($command)
    {
        return $command instanceof ShouldBeQueued;
    }
}