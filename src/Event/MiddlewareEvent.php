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
     * @var array
     */
    protected $config;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @var array $stack
     */
    protected $stack;

    /**
     * @param Service $service
     * @param array $stack
     */
    function __construct(Service $service, array $stack = [])
    {
        $this->service = $service;
        $this->config = [current($stack)];
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
        return function(...$params) {
            return ($middleware = next($this->stack)) ? $this->call($middleware, $params) : ($params ? end($params) : null);
        };
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
