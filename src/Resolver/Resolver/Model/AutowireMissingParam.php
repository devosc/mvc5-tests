<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class AutowireMissingParam
{
    /**
     * @var
     */
    protected $foo;

    /**
     * @param $foo
     */
    function __construct($foo)
    {
        $this->foo = $foo;
    }
}
