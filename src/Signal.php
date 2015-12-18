<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Plugin\Gem\Config;
use Mvc5\Signal as Base;

abstract class Signal
{
    /**
     *
     */
    use Base;

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

    /**
     * @param callable|object $config
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function testSignal(callable $config, array $args = [], callable $callback = null)
    {
        return $this->signal($config, $args, $callback);
    }
}
