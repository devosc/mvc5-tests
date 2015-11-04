<?php

namespace Mvc5\Test\Event;

use Mvc5\Event\Base;
use Mvc5\Event\Event as BaseEvent;

class EventConstantName
    implements BaseEvent
{
    /**
     *
     */
    use Base;

    /**
     *
     */
    const EVENT = 'foo';
}
