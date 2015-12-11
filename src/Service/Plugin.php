<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Plugin as Base;
use Mvc5\Service\Service;

abstract class Plugin
{
    /**
     *
     */
    use Base;

    /**
     * @param $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @param array|callable|object|string $name
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    public function callTest($name, array $args = [], callable $callback = null)
    {
        return $this->call($name, $args, $callback);
    }

    /**
     * @param array|callable|null|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    public function createTest($config, array $args = [], callable $callback = null)
    {
        return $this->create($config, $args, $callback);
    }

    /**
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function invokableTest($config) : callable
    {
        return $this->invokable($config);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function paramTest($name)
    {
        return $this->param($name);
    }

    /**
     * @param string $name
     * @param callable $callback
     * @param array $args
     * @return callable|null|object
     */
    public function pluginTest($name, array $args = [], callable $callback = null)
    {
        return $this->plugin($name, $args, $callback);
    }

    /**
     * @param array|object|string|\Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    public function triggerTest($event, array $args = [], callable $callback = null)
    {
        return $this->trigger($event, $args, $callback);
    }
}
