<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\View\Renderer as Base;

class Renderer
{
    /**
     *
     */
    use Base {
        exception as public;
        render    as public;
    }

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
