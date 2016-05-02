<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Model;

class HydrateService
    extends \ArrayObject
{
    /**
     * @param $index
     * @param $item
     * @param $foo
     */
    function __invoke($index, $item, $foo)
    {
        return $item[$index] = $foo;
    }
}
