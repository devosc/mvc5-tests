<?php

namespace Mvc5\Test\Service\Resolver;

class AutowireMissingParam
{
    /**
     * @var
     */
    protected $foo;

    /**
     * @param $foo
     */
    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}
