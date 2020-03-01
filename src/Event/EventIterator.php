<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\ArrayModel;
use Mvc5\Config\Count;
use Mvc5\Config\Iterator;
use Mvc5\Config\Model;
use Mvc5\Event\Event;
use Mvc5\Event\EventModel;

class EventIterator
    implements \Countable, Event, \Iterator
{
    /**
     *
     */
    use Count;
    use Iterator;
    use EventModel;

    /**
     * @var Model
     */
    protected Model $config;

    /**
     * @var bool
     */
    public $num_valid_method_calls = 0;

    /**
     * @param $config array|mixed
     */
    function __construct($config = [])
    {
        $this->config = $config instanceof Model ? $config : new ArrayModel($config);
    }

    /**
     * @return bool
     */
    function valid() : bool
    {
        ++$this->num_valid_method_calls;

        return $this->config->valid();
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     * @throws \Throwable
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        return $this->signal(
            $callable, !$args ? $this->args() : (!is_string(key($args)) ? $args : $this->args() + $args), $callback
        );
    }
}
