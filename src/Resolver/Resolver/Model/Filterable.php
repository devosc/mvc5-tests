<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class Filterable
{
    /**
     * @param $foo
     * @param $bar
     */
    function __invoke($foo, $bar)
    {
        return $foo;
    }
}
