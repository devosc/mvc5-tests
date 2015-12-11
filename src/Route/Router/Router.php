<?php

namespace Mvc5\Test\Route\Router;

use Mvc5\Route\Definition;
use Mvc5\Route\Route;
use Mvc5\Route\Router\Router as Base;

abstract class Router
{
    /**
     *
     */
    use Base;

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function routeDefinitionTest($definition)
    {
        return $this->routeDefinition($definition);
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function dispatchTest(Route $route, Definition $definition)
    {
        return $this->dispatch($route, $definition);
    }

    /**
     * @return string
     */
    public function nameTest()
    {
        return $this->name();
    }
}
