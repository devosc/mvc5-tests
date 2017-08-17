<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Iterator;
use Mvc5\Event\Event;
use Mvc5\Event\EventModel;
use Mvc5\Service\Service;

class MiddlewareEvent
    extends Iterator
    implements Event
{
    /**
     *
     */
    use EventModel;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @param Service $service
     * @param array|\Iterator $config
     */
    function __construct(Service $service, $config = [])
    {
        parent::__construct($config);
        $this->service = $service;
    }

    /**
     * @param array $args
     * @return array
     */
    protected function args(array $args)
    {
        $args[] = function(...$args) {
            return ($middleware = $this->next()) ? $this->call($middleware, $args) : ($args ? end($args) : null);
        };

        return $args;
    }

    /**
     * @param $middleware
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function call($middleware, $args, callable $callback = null)
    {
        return $this->service->call($middleware, $this->args($args), $callback);
    }

    /**
     * @return mixed
     */
    function next()
    {
        if ($this->config instanceof \Iterator) {
            $this->config->next();
            return $this->config->current();
        }

        return next($this->config);
    }

    /**
     *
     */
    function rewind()
    {
        $this->stopped = false;
        $this->config instanceof \Iterator ? $this->config->rewind() : reset($this->config);
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke($callable, array $args = [], callable $callback = null)
    {
        $result = $this->call($callable, $args, $callback);

        $this->stop();

        return $result;
    }
}
