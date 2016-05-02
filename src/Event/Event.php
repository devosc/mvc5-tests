<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Model;

class Event
{
    /**
     *
     */
    use Model;

    /**
     *
     */
    const EVENT = 'baz';

    /**
     * @param $event
     */
    function __construct($event = null)
    {
        $event && $this->event = $event;
    }
}
