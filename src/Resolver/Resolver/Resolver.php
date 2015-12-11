<?php

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Event\Event;
use Mvc5\Plugin\Gem\Child;
use Mvc5\Plugin\Gem\Plugin;
use Mvc5\Resolver\Resolver as Base;

abstract class Resolver
{
    /**
     *
     */
    use Base;

    /**
     * @param $args
     * @return array|callable|null|object|string
     */
    public function argsTest($args)
    {
        return $this->args($args);
    }

    /**
     * @param array $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function buildTest(array $config, array $args = [], callable $callback = null)
    {
        return $this->build($config, $args, $callback);
    }

    /**
     * @param Child $config
     * @param array $args
     * @return array|callable|object|string
     */
    public function childTest(Child $config, array $args = [])
    {
        return $this->child($config, $args);
    }

    /**
     * @param mixed $service
     * @param array $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function composeTest($service, array $config, array $args = [], callable $callback = null)
    {
        return $this->compose($service, $config, $args, $callback);
    }

    /**
     * @param array|Event|string $event
     * @return Event
     */
    public function eventTest($event)
    {
        return $this->event($event);
    }

    /**
     * @param array|callable|null|object|string $arg
     * @param array $filters
     * @return mixed
     */
    public function filterTest($arg, array $filters)
    {
        return $this->filter($arg, $filters);
    }

    /**
     * @param Plugin $config
     * @param object $service
     * @return object
     */
    public function hydrateTest(Plugin $config, $service)
    {
        return $this->hydrate($config, $service);
    }

    /**
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function invokableTest($config)
    {
        return $this->invokable($config);
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return array|callable|object|string
     */
    public function invokeTest($config, array $args = [], callable $callback = null)
    {
        return $this->invoke($config, $args, $callback);
    }

    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function makeTest($name, array $args = [], callable $callback = null)
    {
        return $this->make($name, $args, $callback);
    }

    /**
     * @param Plugin $parent
     * @param Plugin $config
     * @return Plugin
     */
    public function mergeTest(Plugin $parent, Plugin $config)
    {
        return $this->merge($parent, $config);
    }

    /**
     * @param $config
     * @return array|callable|Plugin|null|object|string
     */
    public function parentTest($config)
    {
        return $this->parent($config);
    }

    /**
     * @param Plugin $config
     * @param array $args
     * @return callable|null|object
     */
    public function provideTest(Plugin $config, array $args = [])
    {
        return $this->provide($config, $args);
    }

    /**
     * @param $config
     * @param array $args
     * @return array|callable|null|object|string
     */
    public function resolveTest($config, array $args = [])
    {
        return $this->resolve($config, $args);
    }

    /**
     * @param $config
     * @return mixed
     */
    public function solveTest($config)
    {
        return $this->solve($config);
    }
}
