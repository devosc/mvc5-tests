<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class CallObject
{
    /**
     * @return string
     */
    function test3()
    {
        return 'foo';
    }

    /**
     * @param $foo
     * @param $bar
     * @return mixed
     */
    function __invoke($foo, $bar)
    {
        return $foo;
    }
}
