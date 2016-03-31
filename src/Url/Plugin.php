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
     * @param string $name
     * @param array $args
     * @return string
     */
    public function url($name, array $args = [])
    {
        return parent::url($name, $args);
    }
}
