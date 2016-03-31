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
     * @param $name
     * @return array|Definition
     */
    public function config($name)
    {
        return parent::config($name);
    }

    /**
     * @param array|Definition $definition
     * @return Definition|null
     */
    public function url($definition)
    {
        return parent::url($definition);
    }

    /**
     * @param string $name
     * @return string
     */
    public function name($name)
    {
        return parent::name($name);
    }

    /**
     * @param array|string $name
     * @param array $args
     * @param Definition $definition
     * @return string|void
     * @throws \RuntimeException
     */
    public function generate($name, array $args = [], Definition $definition = null)
    {
        return parent::generate($name, $args, $definition);
    }
}
