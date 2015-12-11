<?php

namespace Mvc5\Test\Resolver\Resolver\Model;

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
