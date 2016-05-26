<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Event;
use Mvc5\Event\Signal;

class TestEvent
    implements Event
{
    /**
     *
     */
    use Signal;

    /**
     *
     */
    const EVENT = 'test_event';

    /**
     * @param $event
     */
    function __construct($event = null)
    {
        $event && $this->event = $event;
    }
}
