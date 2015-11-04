<?php

namespace Mvc5\Test\Event;

use Mvc5\Event\Base;
use Mvc5\Event\Event as BaseEvent;

class EventName
    implements BaseEvent
{
    /**
     *
     */
    use Base;

    /**
     * @param string $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }
}
