<?php

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
    public function configTest($name)
    {
        return $this->config($name);
    }

    /**
     * @param array|Definition $definition
     * @return Definition|null
     */
    public function urlTest($definition)
    {
        return $this->url($definition);
    }

    /**
     * @param string $name
     * @return string
     */
    public function nameTest($name)
    {
        return $this->name($name);
    }

    /**
     * @param array|string $name
     * @param array $args
     * @param Definition $definition
     * @return string|void
     * @throws \RuntimeException
     */
    public function generateTest($name, array $args = [], Definition $definition = null)
    {
        return $this->generate($name, $args, $definition);
    }
}
