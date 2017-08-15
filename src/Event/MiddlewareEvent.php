<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Config\Iterator;
use Mvc5\Event\Event;
use Mvc5\Event\Model;
use Mvc5\Service\Service;

class MiddlewareEvent
    implements \Countable, Event, \Iterator
{
    /**
     *
     */
    use Model;
    use Iterator;

    /**
     * @var array|null
     */
    public $args;

    /**
     * @var array|\Iterator
     */
    protected $config;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @param Service $service
     * @param array|\Iterator $config
     */
    function __construct(Service $service, $config)
    {
        $this->service = $service;
        $this->config = $config;
    }

    /**
     * @param array $args
     * @return array
     */
    protected function args(array $args = [])
    {
        (null !== $this->args) && $args = $this->args;

        $args[] = function(...$args) {
            $this->args = $args;
            return $this;
        };

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
     * @param array $args
     * @return mixed|null
     */
    protected function end(array $args)
    {
        null !== $this->args && $args = $this->args;
        return $args ? end($args) : null;
    }

    /**
     * @return mixed|null
     */
    protected function step()
    {
        return !$this->stopped() ? $this->current() : null;
    }

    /**
     * @param callable $callable
     * @param array $args
     * @return mixed
     */
    function __invoke($callable, array $args = [])
    {
        $result = !$this->stopped() ? $this->call($callable, $this->args($args)) : $this->end($args);

        if ($result !== $this && $this->stop()) {
            $this->args = null;
            return $result;
        }

        $end = $this->end($this->args);

        !$this->valid() && $this->args = null;

        return $end;
    }
}
