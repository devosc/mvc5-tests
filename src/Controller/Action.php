<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Action as ControllerAction;

class Action
    extends ControllerAction
{
    /**
     * @param array|callable|object|string $name
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    protected function call($name, array $args = [], callable $callback = null)
    {
        return 'foo';
    }
}
