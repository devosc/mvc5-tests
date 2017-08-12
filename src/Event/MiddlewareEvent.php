<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Config\Iterator;
use Mvc5\Event\Event;
use Mvc5\Event\EventModel;
use Mvc5\Service\Service;

class MiddlewareEvent
    implements \Countable, Event, \Iterator
{
    /**
     *
     */
    use Iterator;
    use EventModel;

    /**
     * @var array|\Iterator
     */
    protected $config;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @var array|\Iterator $stack
     */
    protected $stack;

    /**
     * @param Service $service
     * @param array|\Iterator $stack
     */
    function __construct(Service $service, $stack)
    {
        $this->service = $service;
        $this->config = [$this->start($stack)];
        $this->stack = $stack;
    }

    /**
     * @param array $args
     * @return array
     */
    protected function args(array $args = [])
    {
        $args[] = $this->callable();
        return $args;
    }

    /**
     * @param callable $middleware
     * @param array $args
     * @return mixed
     */
    protected function call($middleware, array $args = [])
    {
        return $this->service->call($middleware, $this->args($args));
    }

    /**
     * @return \Closure
     */
    protected function callable()
    {
        return function(...$args) {
            return ($middleware = $this->step($this->stack)) ? $this->call($middleware, $args) : $this->end($args);
        };
    }

    /**
     * @param array $args
     * @return mixed|null
     */
    protected function end(array $args)
    {
        return $args ? end($args) : null;
    }

    /**
     *
     */
    function rewind()
    {
        reset($this->config);
        is_array($this->stack) ? reset($this->stack) : $this->stack->rewind();
    }

    /**
     * @param array|\Iterator $stack
     * @return mixed|null
     */
    protected function start(&$stack)
    {
        if (is_array($stack)) {
            return reset($stack);
        }

        $stack->rewind();

        return $stack->current();
    }

    /**
     * @param array|\Iterator $stack
     * @return mixed|null
     */
    protected function step(&$stack)
    {
        if (is_array($stack)) {
            return next($stack);
        }

        $stack->next();

        return $stack->current();
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        return $this->signal($callable, $this->args($args), $callback);
    }
}
