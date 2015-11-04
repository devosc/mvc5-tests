<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Event\Event;
use Mvc5\Event\Manager\Events as Base;

abstract class Events
{
    /**
     *
     */
    use Base;

    /**
     * @param callable|Event|string $event
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function testEmit($event, callable $listener, array $args = [], callable $callback = null)
    {
        return $this->emit($event, $listener, $args, $callback);
    }

    /**
     * @param array|Event|string $event
     * @return Event
     */
    public function testEvent($event)
    {
        return $this->event($event);
    }

    /**
     * @param array|callable|string $listener
     * @return callable
     */
    public function testListener($listener)
    {
        return $this->listener($listener);
    }
}
