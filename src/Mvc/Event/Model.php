<?php
/**
 *
 */

namespace Mvc5\Test\Mvc\Event;

use Mvc5\Mvc\Event\Model as Base;
use Mvc5\Response\Response;
use Mvc5\Route\Route;

class Model
{
    /**
     *
     */
    use Base;

    /**
     * @return callable|object|null|string
     */
    public function controllerTest()
    {
        return $this->controller();
    }

    /**
     * @param $model|null
     * @return array|callable|null|object|string
     */
    public function modelTest($model = null)
    {
        return $this->model($model);
    }

    /**
     * @return Response
     */
    public function responseTest()
    {
        return $this->response();
    }

    /**
     * @param Route|null $route
     * @return Route
     */
    public function routeTest(Route $route = null)
    {
        return $this->route($route);
    }
}
