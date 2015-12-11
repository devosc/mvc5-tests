<?php

namespace Mvc5\Test\Resolver\Resolver\Model;

use Mvc5\Event\Signal;
use Mvc5\Event\Event;

class CallEvent
    implements Event
{
    /**
     *
     */
    use Signal;

    /**
     *
     */
    const EVENT = 'callable:event';
}
