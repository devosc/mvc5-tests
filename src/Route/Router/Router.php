<?php
/**
 *
 */

namespace Mvc5\Test\Route\Router;

use Mvc5\Plugin as Service;
use Mvc5\Route\Dispatcher;
use Mvc5\Route\Route;
use Mvc5\Route\Router\Router as Base;

class Router
{
    /**
     *
     */
    use Dispatcher {
        definition as public;
    }
    use Service;
    use Base {
        dispatch        as public;
        name            as public;
        routeDefinition as public;
    }

    /**
     * @return null|string
     */
    function request()
    {
        return $this->request;
    }

    /**
     * @return Route
     */
    function route()
    {
        return $this->route;
    }
}
