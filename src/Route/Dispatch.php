<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Route\Dispatch\Router as _Router;

class Dispatch
{
    /**
     *
     */
    use _Router {
        definition      as public;
        dispatch        as public;
        match           as public;
        name            as public;
        request         as public;
        route           as public;
        routeDefinition as public;
    }

    /**
     * @return array|\Mvc5\Route\Route
     */
    function requestClass()
    {
        return $this->request;
    }

    /**
     * @return array|\Mvc5\Route\Route
     */
    function configuredRoute()
    {
        return $this->route;
    }
}
