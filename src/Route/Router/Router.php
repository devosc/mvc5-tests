<?php

namespace Mvc5\Test\Route\Router;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Route;
use Mvc5\Route\Router\Router as Base;

class Router
    extends Base
{
    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function testCreate($definition)
    {
        return $this->create($definition);
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function testDispatch(Route $route, Definition $definition)
    {
        return $this->dispatch($route, $definition);
    }

    /**
     * @return string
     */
    public function testName()
    {
        return $this->name();
    }
}
