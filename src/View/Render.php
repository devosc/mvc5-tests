<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\View\Template\Render as _Render;

class Render
{
    /**
     *
     */
    use _Render {
        render as public;
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
