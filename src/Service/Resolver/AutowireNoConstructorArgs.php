<?php

namespace Mvc5\Test\Service\Resolver;

class AutowireNoConstructorArgs
{
    /**
     *
     *
     */
    public function __construct()
    {
        $args = func_get_args();

        if (!$args[0] instanceof CallEvent) {
            throw new \InvalidArgumentException('Invalid argument: ' . $args[0]);
        }

        if ('bar' !== $args[1]) {
            throw new \InvalidArgumentException('Invalid argument: ' . $args[1]);
        }
    }
}
