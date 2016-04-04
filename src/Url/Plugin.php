<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Route\Definition;
use Mvc5\Url\Plugin as Base;

class Plugin
    extends Base
{

    /**
     * @return callable
     */
    public function generator()
    {
        return parent::generator();
    }

    /**
     * @param null|string $name
     * @return string
     */
    public function name($name = null)
    {
        return parent::name($name);
    }

    /**
     * @param array $options
     * @return array
     */
    public function options(array $options = [])
    {
        return parent::options($options);
    }

    /**
     * @param null|string $name
     * @param array $args
     * @return array
     */
    public function params($name = null, array $args = [])
    {
        return parent::params($name, $args);
    }

    /**
     * @param string $name
     * @param array $args
     * @param array $options
     * @return string
     */
    public function url($name, array $args = [], array $options = [])
    {
        return parent::url($name, $args, $options);
    }
}
