<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class CallableObject
{
    function bar()
    {
    }

    static function test()
    {
        return 'foo';
    }

    static function test2()
    {
        return new CallObject;
    }

    static function __callStatic($name, $args = [])
    {
    }

    function __invoke($foo = null)
    {
        return $foo;
    }
}
