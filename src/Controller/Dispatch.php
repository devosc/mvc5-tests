<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Controller\Dispatch as ControllerDispatch;

class Dispatch
    extends ControllerDispatch
{
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
