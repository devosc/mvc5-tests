<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Event\Base;
use Mvc5\Event\Event;

class CallEvent
    implements Event
{
    /**
     *
     */
    use Base;

    /**
     *
     */
    const EVENT = 'callable:event';
}
