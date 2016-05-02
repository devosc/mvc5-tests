<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Route\Definition;
use Mvc5\Url\Generator as Base;

class Generator
    extends Base
{
    /**
     * @param Definition $parent
     * @param $name
     * @return Definition
     */
    function child(Definition $parent, $name)
    {
        return parent::child($parent, $name);
    }

    /**
     * @param $name
     * @return array|Definition
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
     * @param Definition $parent
     * @return string|void
     */
    function generate($name, array $args = [], array $options = [], $path = '', Definition $parent = null)
    {
        return parent::generate($name, $args, $options, $path, $parent);
    }

    /**
     * @param Definition $parent
     * @param Definition $child
     * @return Definition
     */
    function merge(Definition $parent, Definition $child)
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
     * @param array|Definition $definition
     * @return Definition|null
     */
    function url($definition)
    {
        return parent::url($definition);
    }
}
