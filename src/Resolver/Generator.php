<?php

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Generator as Base;

abstract class Generator
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @return array|\Traversable|null
     */
    public function listenersTest($name)
    {
        return $this->listeners($name);
    }
}
