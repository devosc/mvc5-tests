<?php

namespace Mvc5\Test\Event\Generator;

use Mvc5\Event\Event;
use Mvc5\Event\Generator\EventGenerator as Base;

abstract class EventGenerator
{
    /**
     *
     */
    use Base;

    /**
     * @param callable|Event|string|\Traversable $event
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
     * @param Event|string|\Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    public function testGenerate($event, array $args = [], callable $callback = null)
    {
        return $this->generate($event, $args, $callback);
    }

    /**
     * @param Event|string|\Traversable $event
     * @return \Generator
     */
    public function testQueue($event)
    {
        return $this->queue($event);
    }
}
