<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Config\Count;
use Mvc5\Config\Iterator;
use Mvc5\Event\Event;
use Mvc5\Event\EventModel;
use Mvc5\Service\Middleware;

class MiddlewareEvent
    implements \Countable, Event, \Iterator
{
    /**
     *
     */
    use Count;
    use EventModel;
    use Iterator;
    use Middleware {
        Middleware::next insteadof Iterator;
        next as public;
        rewind as reset;
    }

    /**
     *
     */
    function rewind()
    {
        $this->stopped = false;
        $this->reset();
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke($callable, array $args = [], callable $callback = null)
    {
        $result = $this->call($callable, $args);

        $this->stop();

        return $result;
    }
}
