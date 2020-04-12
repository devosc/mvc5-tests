<?php
/**
 *
 */

namespace Mvc5\Test\Service\Builder;

final class Variadic
{
    /**
     * @var array
     */
    public $args = [];

    /**
     * @param $foo
     * @param array ...$args
     */
    function __construct($foo, ...$args)
    {
        $this->args = array_merge([$foo], $args);
    }
}
