<?php

namespace Mvc5\Test\Service\Manager;

use Mvc5\Service\Manager\Initializer as Base;

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
     * @param array $args
     * @param callable $callback
     * @return null|object|callable
     */
    public function testInitialize($name, array $args = [], callable $callback = null)
    {
        return $this->initialize($name, $args, $callback);
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
