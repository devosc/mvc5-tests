<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Definition\Build\Base as BuildBase;

class Base
{
    /**
     *
     */
    use BuildBase;

    /**
     * @param array|Definition $definition
     * @param bool $compile
     * @param bool $recursive
     * @return Definition
     */
    public function testBuild($definition, $compile = true, $recursive = false)
    {
        return $this->build($definition, $compile, $recursive);
    }

    /**
     * @param array $definitions
     * @param bool $compile
     * @param bool $recursive
     * @return array
     */
    public function testChildren(array $definitions, $compile = true, $recursive = true)
    {
        return $this->children($definitions, $compile, $recursive);
    }

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function testCreate($definition)
    {
        return $this->create($definition);
    }

    /**
     * @param array|Definition $definition
     * @param bool $compile
     * @param bool $recursive
     * @return Definition
     */
    public function testDefinition($definition, $compile = true, $recursive = false)
    {
        return $this->definition($definition, $compile, $recursive);
    }
}
