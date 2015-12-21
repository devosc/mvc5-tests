<?php

namespace Mvc5\Test\Resolver\Build;

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
     * @param array $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function combineTest(array $config, array $args = [], callable $callback = null)
    {
        return $this->combine($config, $args, $callback);
    }

    /**
     * @param $plugin
     * @param array $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function composeTest($plugin, array $config = [], array $args = [], callable $callback = null)
    {
        return $this->compose($plugin, $config, $args, $callback);
    }

    /**
     * @param $plugin
     * @param $name
     * @param array $args
     * @param callable|null $callback
     * @return array|callable|Plugin|null|object|string
     */
    public function compositeTest($plugin, $name, array $args = [], callable $callback = null)
    {
        return $this->composite($plugin, $name, $args, $callback);
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
     * @param $name
     * @param array $config
     * @param array $args
     * @param callable $callback
     * @return callable|object
     */
    public function firstTest($name, array $config, array $args = [], callable $callback = null)
    {
        return $this->first($name, $config, $args, $callback);
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
