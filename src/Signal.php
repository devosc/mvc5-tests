<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Plugin\Gem\SignalArgs;
use Mvc5\Plugin\Gem\Config;
use Mvc5\Signal as _Signal;

class Signal
{
    /**
     *
     */
    use _Signal {
        signal as public;
    }

    /**
     * @param $foo
     * @return mixed
     */
    function staticTest($foo)
    {
        return $foo;
    }

    /**
     * @param $foo
     * @return string
     */
    static function optionalArgTest($foo = 'foo')
    {
        return $foo;
    }

    /**
     * @param array ...$args
     * @return array|null
     */
    static function variadicArgsTest(...$args)
    {
        return $args[0] instanceof SignalArgs ? $args[0]->args() : null;
    }

    /**
     * @param ...$args
     * @return mixed
     */
    static function argsTest($args)
    {
        return $args;
    }

    /**
     * @param $foo
     * @param $baz
     * @param Config $config
     * @param array $args
     * @return string
     */
    function staticRequiredTest($foo, $baz, Config $config, array $args = [])
    {
        return $foo . ' ' . $baz;
    }

    /**
     * @param $foo
     * @param $baz
     * @return string
     */
    function staticRequiredExceptionTest($foo, $baz)
    {
        return $foo . ' ' . $baz;
    }
}
