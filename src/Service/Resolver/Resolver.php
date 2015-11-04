<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Service\Config\Configuration as Config;
use Mvc5\Service\Config\Child\ChildService;
use Mvc5\Service\Resolver\Resolver as Base;

abstract class Resolver
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param callable $callback
     * @param array $args
     * @return callable|null|object
     */
    public function plugin($name, array $args = [], callable $callback = null)
    {
        return $callback ? $callback($name, $args) : $name;
    }

    /**
     * @param $args
     * @return array|callable|null|object|string
     */
    public function testArgs($args)
    {
        return $this->args($args);
    }

    /**
     * @param array $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function testBuild(array $config, array $args = [], callable $callback = null)
    {
        return $this->build($config, $args, $callback);
    }

    /**
     * @param ChildService $config
     * @param array $args
     * @return array|callable|object|string
     */
    public function testChild(ChildService $config, array $args = [])
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
    public function testCompose($service, array $config, array $args = [], callable $callback = null)
    {
        return $this->compose($service, $config, $args, $callback);
    }

    /**
     * @param array|callable|null|object|string $arg
     * @param array $filters
     * @return mixed
     */
    public function testFilter($arg, array $filters)
    {
        return $this->filter($arg, $filters);
    }

    /**
     * @param Config $config
     * @param object $service
     * @return object
     */
    public function testHydrate(Config $config, $service)
    {
        return $this->hydrate($config, $service);
    }

    /**
     * @param array|callable|object|string $config
     * @return callable|null
     */
    public function testInvokable($config)
    {
        return $this->invokable($config);
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return array|callable|object|string
     */
    public function testInvoke($config, array $args = [], callable $callback = null)
    {
        return $this->invoke($config, $args, $callback);
    }

    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function testMake($name, array $args = [], callable $callback = null)
    {
        return $this->make($name, $args, $callback);
    }

    /**
     * @param Config $parent
     * @param Config $config
     * @return Config
     */
    public function testMerge(Config $parent, Config $config)
    {
        return $this->merge($parent, $config);
    }

    /**
     * @param Config $config
     * @param array $args
     * @return callable|null|object
     */
    public function testProvide(Config $config, array $args = [])
    {
        return $this->provide($config, $args);
    }

    /**
     * @param $config
     * @param array $args
     * @return array|callable|null|object|string
     */
    public function testResolve($config, array $args = [])
    {
        return $this->resolve($config, $args);
    }
    /**
     * @param $config
     * @return mixed
     */
    public function testSolve($config)
    {
        return $this->solve($config);
    }
}
