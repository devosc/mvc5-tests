<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Route\Dispatcher as Base;

class Dispatcher
{
    /**
     *
     */
    use Base {
        definition as public;
        exception  as public;
        match      as public;
        route      as public;
    }

    /**
     * @param array|callable|object|string $name
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    function call($name, array $args = [], callable $callback = null)
    {
        return 'foo';
    }

    /**
     * @param array|object|string|\Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    protected function trigger($event, array $args = [], callable $callback = null)
    {
        return 'foo';
    }
}
