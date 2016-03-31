<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Plugin\Gem\SignalArgs;
use Mvc5\Plugin\Gem\Config;
use Mvc5\Signal as Base;

class Signal
{
    /**
     *
     */
    use Base {
        signal as public;
    }

    /**
     * @param $foo
     * @return mixed
     */
    public function staticTest($foo)
    {
        return $foo;
    }

    /**
     * @param $foo
     * @return string
     */
    public static function optionalArgTest($foo = 'foo')
    {
        return $foo;
    }

    /**
     * @param ...$args
     * @return mixed
     */
    public static function variadicArgsTest(...$args)
    {
        return $args[0] instanceof SignalArgs ? $args[0]->args() : null;
    }

    /**
     * @param ...$args
     * @return mixed
     */
    public static function argsTest($args)
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
    public function staticRequiredTest($foo, $baz, Config $config, array $args = [])
    {
        return $foo . ' ' . $baz;
    }

    /**
     * @param $foo
     * @param $baz
     * @return string
     */
    public function staticRequiredExceptionTest($foo, $baz)
    {
        return $foo . ' ' . $baz;
    }
}
