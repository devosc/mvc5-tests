<?php

namespace Mvc5\Test\Service\Resolver;

class HydrateService
    extends \ArrayObject
{
    /**
     * @param $index
     * @param $item
     */
    public function __invoke($index, $item, $foo)
    {
        return $item[$index] = $foo;
    }
}
