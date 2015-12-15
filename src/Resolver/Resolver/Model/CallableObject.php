<?php

namespace Mvc5\Test\Resolver\Resolver\Model;

class CallableObject
{
    public function bar()
    {
    }

    public static function test()
    {
        return 'foo';
    }

    public static function __callStatic($name, $args = [])
    {
    }

    public function __invoke()
    {
    }
}
