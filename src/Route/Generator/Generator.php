<?php

namespace Mvc5\Test\Route\Generator;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Generator\Generator as Base;

class Generator
    extends Base
{
    /**
     * @param array|string $name
     * @param array $args
     * @param Definition $definition
     * @return string|void
     * @throws \Exception
     */
    public function testBuild($name, array $args = [], Definition $definition = null)
    {
        return $this->build($name, $args, $definition);
    }

    /**
     * @param $name
     * @return Definition
     */
    public function testConfig($name)
    {
        return $this->config($name);
    }

    /**
     * @param array|Definition $definition
     * @return Definition|null
     */
    public function testCreate($definition)
    {
        return $this->create($definition);
    }

    /**
     * @param string $name
     * @return string
     */
    public function testName($name)
    {
        return $this->name($name);
    }
}
