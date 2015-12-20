<?php

namespace Mvc5\Test\Resolver\Resolver;

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
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function callableTest($config) : callable
    {
        return $this->callable($config);
    }

    /**
     * @param $name
     * @param array $args
     * @param callable|null $callback
     * @return callable|object
     */
    public function callbackTest($name, array $args = [], callable $callback = null)
    {
        return $this->callback($name, $args, $callback);
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
     * @param $name
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function createTest($name, array $args = [], callable $callback = null)
    {
        return $this->create($name, $args, $callback);
    }

    /**
     * @param array|object|string|\Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    public function eventTest($event, array $args = [], callable $callback = null)
    {
        return $this->event($event, $args, $callback);
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
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function listenerTest($config)
    {
        return $this->listener($config);
    }

    /**
     * @param string $name
     * @param array $args
     * @return callable|object
     */
    public function makeTest($name, array $args = [])
    {
        return $this->make($name, $args);
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
     * @param $plugin
     * @param array $config
     * @param array $args
     * @param callable|null $callback
     * @return array|callable|object|string
     */
    public function relayTest($plugin, array $config = [], array $args = [], callable $callback = null)
    {
        return $this->relay($plugin, $config, $args, $callback);
    }

    /**
     * @param $config
     * @param array $args
     * @param callable $callback
     * @return array|callable|null|object|string
     */
    public function resolvableTest($config, array $args = [], callable $callback = null)
    {
        return $this->resolvable($config, $args, $callback);
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
     * @return callable|mixed|null|object
     */
    public function resolverTest($config)
    {
        return $this->resolver($config);
    }

    /**
     * @param $config
     * @return mixed
     */
    public function solveTest($config)
    {
        return $this->solve($config);
    }

    /**
     * @param array $config
     * @param array $args
     * @param callable|null $callback
     * @return array|callable|object|string
     */
    public function transmitTest(array $config = [], array $args = [], callable $callback = null)
    {
        return $this->transmit($config, $args, $callback);
    }

    /**
     * @param $name
     * @param $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function uniqueTest($name, $config, array $args = [], callable $callback = null)
    {
        return $this->unique($name, $config, $args, $callback);
    }
}
