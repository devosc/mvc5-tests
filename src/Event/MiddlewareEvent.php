<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Config\Base;
use Mvc5\Config\Iterator;
use Mvc5\Event\Event;
use Mvc5\Event\EventModel;

class MiddlewareEvent
    implements \Countable, Event, \Iterator
{
    /**
     *
     */
    use Base;
    use EventModel;
    use Iterator;

    /**
     * @param array $args
     * @return array
     */
    protected function args(array $args = [])
    {
        $args[] = function(...$args) {
            return ($middleware = $this->middleware()) ? $this->call($middleware, $args) : $this->end($args);
        };

        return $args;
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
     * @param callable $middleware
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function call($middleware, array $args = [], callable $callback = null)
    {
        return $this->signal($middleware, $this->args($args), $callback);
    }

    /**
     *
     */
    function middleware()
    {
        $this->next();
        return $this->current();
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
        $result = $this->call($callable, $this->args($args), $callback);

        $this->stop();

        return $result;
    }
}
