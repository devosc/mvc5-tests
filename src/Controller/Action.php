<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Action as ControllerAction;

class Action
{
    /**
     *
     */
    use ControllerAction {
        action    as public;
        error     as public;
        exception as public;
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws \RuntimeException
     */
    public function call($config, array $args = [], callable $callback = null)
    {
        return 'foo';
    }
}
