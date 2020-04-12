<?php
/**
 *
 */

namespace Mvc5\Test\Service\Builder;

use Mvc5\Model;

final class NoConstructorArgs
{
    /**
     *
     *
     */
    function __construct()
    {
        $args = func_get_args();

        if (!$args[0] instanceof Model) {
            throw new \InvalidArgumentException('Invalid argument: ' . $args[0]);
        }

        if ('bar' !== $args[1]) {
            throw new \InvalidArgumentException('Invalid argument: ' . $args[1]);
        }
    }
}
