<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Service\Config\ConfigLink\ConfigLink;
use Mvc5\Service\Resolver\Signal as Base;

class Signal
{
    /**
     *
     */
    use Base;

    public function staticTest($foo)
    {
        return $foo;
    }

    public function staticRequiredTest($foo, $baz, ConfigLink $configLink, array $args = [])
    {
        return $foo . ' ' . $baz;
    }

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
