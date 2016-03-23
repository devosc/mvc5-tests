<?php

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Generator as Base;

abstract class Generator
{
    /**
     *
     */
    use Base;

    /**
     * @param $event
     * @return string
     */
    public function eventNameTest($event)
    {
        return $this->eventName($event);
    }

    /**
     * @param string $name
     * @return array|\Traversable|null
     */
    public function listenersTest($name)
    {
        return $this->listeners($name);
    }

    /**
     * @param object|string $event
     * @param array $args
     * @return array|\Traversable|null
     */
    public function traversableTest($event, array $args = [])
    {
        return $this->traversable($event, $args);
    }
}
