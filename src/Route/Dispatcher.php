<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\Definition;
use Mvc5\Route\Dispatcher as Base;
use Mvc5\Route\Route;
use Throwable;

abstract class Dispatcher
{
    /**
     *
     */
    use Base;

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function definitionTest($definition)
    {
        return $this->definition($definition);
    }

    /**
     * @param Throwable $exception
     * @param $route
     * @return mixed
     */
    public function exceptionTest(Throwable $exception, $route)
    {
        return $this->exception($exception, $route);
    }

    /**
     * @param $definition
     * @param $route
     * @return Route
     */
    public function matchTest($definition, $route)
    {
        return $this->match($definition, $route);
    }

    /**
     * @param $route
     * @param array $args
     * @return Route
     */
    public function routeTest($route, array $args = [])
    {
        return $this->route($route, $args);
    }
}
