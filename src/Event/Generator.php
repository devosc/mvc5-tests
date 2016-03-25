<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use \Mvc5\Event\Generator as Base;

abstract class Generator
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
    public function emitTest($event, callable $listener, array $args = [], callable $callback = null)
    {
        return $this->emit($event, $listener, $args, $callback);
    }

    /**
     * @param array|object|string|\Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    public function generateTest($event, array $args = [], callable $callback = null)
    {
        return $this->generate($event, $args, $callback);
    }

    /**
     * @param array|Event|string|\Traversable $event
     * @return array|\Traversable
     */
    public function queueTest($event)
    {
        return $this->queue($event);
    }
}
