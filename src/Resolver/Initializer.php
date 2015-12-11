<?php

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Initializer as Base;

abstract class Initializer
{
    /**
     *
     */
    use Base;

    /**
     * @param array $pending
     */
    public function setPending(array $pending)
    {
        $this->pending = $pending;
    }

    /**
     * @param string $name
     * @param null $config
     * @return null|object|callable
     */
    public function testInitialize($name, $config = null)
    {
        return $this->initialize($name, $config);
    }

    /**
     * @param string $name
     * @param callable|null|object $service
     * @return callable|null|object
     */
    public function testInitialized($name, $service = null)
    {
        return $this->initialized($name, $service);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function testInitializing($name)
    {
        return $this->initializing($name);
    }
}
