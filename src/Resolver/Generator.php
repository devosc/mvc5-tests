<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Generator as Base;

class Generator
{
    /**
     *
     */
    use Base {
        eventName as public;
        listeners as public;
        iterator  as public;
    }

    /**
     * @param array|callable|object|string $config
     * @return callable|null
     */
    protected function callable($config) : callable
    {
        throw new \RuntimeException('Unknown test');
    }

    /**
     * @param $config
     * @param array $args
     * @return array|callable|null|object|string
     */
    protected function resolve($config, array $args = [])
    {
        return $config;
    }
    /**
     * @param callable|object $config
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function signal(callable $config, array $args = [], callable $callback = null)
    {
        throw new \RuntimeException;
    }
}
