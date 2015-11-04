<?php

namespace Mvc5\Test\Service\Resolver;

class Hydrate
{
    /**
     * @param $foo
     * @param $bar
     */
    public function __invoke($foo, $bar)
    {
        return $bar;
    }
}
