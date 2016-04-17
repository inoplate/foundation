<?php

namespace Inoplate\Foundation\Domain;

use Inoplate\Foundation\Domain\Contracts\Event as Contract;

// All events should implements Event Contract as a marker
abstract class Event implements Contract
{
    use Getable;
}