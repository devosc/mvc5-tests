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
        $this->stack = $stack;
        $this->config = [$this->reset()];
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
            return ($middleware = $this->step()) ? $this->call($middleware, $args) : $this->end($args);
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
     * @return mixed|null
     */
    protected function reset()
    {
        if (is_array($this->stack)) {
            return reset($this->stack);
        }

        $this->stack->rewind();

        return $this->stack->current();
    }

    /**
     *
     */
    function rewind()
    {
        reset($this->config);
        $this->reset();
    }

    /**
     * @return mixed|null
     */
    protected function step()
    {
        if (is_array($this->stack)) {
            return next($this->stack);
        }

        $this->stack->next();

        return $this->stack->current();
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
