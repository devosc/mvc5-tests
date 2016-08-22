<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Url\Plugin as _Plugin;

class Plugin
    extends _Plugin
{
    /**
     * @param null|string $name
     * @param array $args
     * @return array
     */
    function args($name = null, array $args = [])
    {
        return parent::args($name, $args);
    }

    /**
     * @return callable
     */
    function generator()
    {
        return parent::generator();
    }

    /**
     * @param null|string $name
     * @return string
     */
    function name($name = null)
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
     * @param string $name
     * @param array $args
     * @param array $options
     * @return string
     */
    function url($name, array $args = [], array $options = [])
    {
        return parent::url($name, $args, $options);
    }
}
