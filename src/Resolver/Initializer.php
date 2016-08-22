<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Initializer as _Initializer;

class Initializer
{
    /**
     *
     */
    use _Initializer {
        initialize   as public;
        initialized  as public;
        initializing as public;
    }

    /**
     * @param string $name
     * @param callable $callback
     * @param array $args
     * @return callable|null|object
     */
    protected function plugin($name, array $args = [], callable $callback = null)
    {
        return new $name;
    }

    /**
     * @param string $name
     * @param mixed $service
     * @return mixed
     */
    protected function set($name, $service)
    {
        return $service;
    }

    /**
     * @param array $pending
     */
    function setPending(array $pending)
    {
        $this->pending = $pending;
    }
}
