<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Service\Service as MvcService;

class Service
    implements MvcService
{
    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws \RuntimeException
     */
    function call($config, array $args = [], callable $callback = null)
    {
        return 'foo';
    }

    /**
     * @param string $name
     * @return mixed
     */
    function param($name)
    {
        return 'foo';
    }

    /**
     * @param string $name
     * @param callable $callback
     * @param array $args
     * @return callable|null|object
     */
    function plugin($name, array $args = [], callable $callback = null)
    {
        return 'foo';
    }

    /**
     * @param string $name
     * @param $config
     * @return callable|null|object
     */
    function shared($name, $config = null)
    {
        return 'foo';
    }

    /**
     * @param array|object|string|\Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    function trigger($event, array $args = [], callable $callback = null)
    {
        return 'foo';
    }
}