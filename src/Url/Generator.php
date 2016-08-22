<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Route\Route;
use Mvc5\Url\Generator as _Generator;

class Generator
    extends _Generator
{
    /**
     * @param Route $parent
     * @param $name
     * @return Route
     */
    function child(Route $parent, $name)
    {
        return parent::child($parent, $name);
    }

    /**
     * @param $name
     * @return array|Route
     */
    function config($name)
    {
        return parent::config($name);
    }

    /**
     * @param array|string $name
     * @param array $args
     * @param array $options
     * @param string $path
     * @param Route $parent
     * @return string|void
     */
    function generate($name, array $args = [], array $options = [], $path = '', Route $parent = null)
    {
        return parent::generate($name, $args, $options, $path, $parent);
    }

    /**
     * @param Route $parent
     * @param Route $child
     * @return Route
     */
    function merge(Route $parent, Route $child)
    {
        return parent::merge($parent, $child);
    }

    /**
     * @param string $name
     * @return string
     */
    function name($name)
    {
        return parent::name($name);
    }

    /**
     * @param array $options
     * @return array
     */
    function options(array $options = [])
    {
        return parent::options($options);
    }

    /**
     * @param array|Route $route
     * @return Route|null
     */
    function url($route)
    {
        return parent::url($route);
    }
}
