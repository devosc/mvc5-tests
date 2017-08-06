<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Config\Iterator;
use Mvc5\Event\Event;
use Mvc5\Event\EventModel;

class EventIterator
    implements \Countable, Event, \Iterator
{
    /**
     *
     */
    use Iterator;
    use EventModel;

    /**
     * @var array|mixed
     */
    protected $config;

    /**
     * @param $config array|mixed
     */
    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        return $this->signal(
            $callable, !$args ? $this->args() : (!is_string(key($args)) ? $args : $this->args() + $args), $callback
        );
    }
}
