<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use \Mvc5\Event\Generator as EventGenerator;

class Generator
{
    /**
     *
     */
    use EventGenerator {
        emit     as public;
        generate as public;
        queue    as public;
    }

    /**
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function callable($config) : callable
    {
        return function(){ return 'foo'; };
    }

    /**
     * @param Event|object|string $event
     * @param array $args
     * @return array|\Traversable|null
     */
    public function traversable($event, array $args = [])
    {
        return ['bar'];
    }
}
