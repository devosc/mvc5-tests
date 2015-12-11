<?php

namespace Mvc5\Test\Url;

use Mvc5\Route\Definition;
use Mvc5\Url\Plugin as Base;

class Plugin
    extends Base
{

    /**
     * @return callable
     */
    public function generatorTest()
    {
        return $this->generator();
    }

    /**
     * @param string $name
     * @param array $args
     * @return string
     */
    public function urlTest($name, array $args = [])
    {
        return $this->url($name, $args);
    }
}
