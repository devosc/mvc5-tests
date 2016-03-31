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
    public function test3()
    {
        return 'foo';
    }

    /**
     * @param $foo
     * @param $bar
     */
    public function __invoke($foo, $bar)
    {
        return $foo;
    }
}
