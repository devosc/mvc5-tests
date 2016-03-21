<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition;
use Mvc5\Route\Definition\Build as Base;

class Build
{
    /**
     *
     */
    use Base;

    /**
     * @param array|Definition $definition
     * @param bool $compile
     * @param bool $recursive
     * @return array|Definition
     */
    public function definitionTest($definition, $compile = true, $recursive = false)
    {
        return $this->definition($definition, $compile, $recursive);
    }

    /**
     * @param array $definitions
     * @param bool $compile
     * @param bool $recursive
     * @return array
     */
    public function childrenTest(array $definitions, $compile = true, $recursive = true)
    {
        return $this->children($definitions, $compile, $recursive);
    }

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function createTest($definition)
    {
        return $this->create($definition);
    }

    /**
     * @param array $definition
     * @return string
     */
    public function createDefaultTest(array $definition = [])
    {
        return $this->createDefault($definition);
    }

    /**
     * @param array|Definition $definition
     * @param bool $compile
     * @param bool $recursive
     * @return Definition
     */
    public function buildTest($definition, $compile = true, $recursive = false)
    {
        return $this->build($definition, $compile, $recursive);
    }
}
