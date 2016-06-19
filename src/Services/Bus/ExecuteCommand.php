<?php

namespace Inoplate\Foundation\Services\Bus;

trait ExecuteCommand
{
    /**
     * Execute commnad
     *
     * @param  mixed         $job
     * @param  Closure|null  $afterResolving
     * @return mixed
     */
    protected function execute($command, $afterResolving = null)
    {
        return app('Inoplate\Foundation\App\Services\Bus\Dispatcher')->dispatch($command, $afterResolving);
    }
}