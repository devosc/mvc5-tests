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
     * @return array|callable|null|object|string
     */
    public function modelTest()
    {
        return $this->model();
    }

    /**
     * @return Response
     */
    public function responseTest()
    {
        return $this->response();
    }

    /**
     * @return Route
     */
    public function routeTest()
    {
        return $this->route();
    }

    /**
     * @param $model
     * @return void
     */
    public function setModelTest($model)
    {
        $this->setModel($model);
    }

    /**
     * @param Response $response
     * @return void
     */
    public function setResponseTest(Response $response)
    {
        $this->setResponse($response);
    }

    /**
     * @param Route $route
     * @return void
     */
    public function setRouteTest(Route $route)
    {
        $this->setRoute($route);
    }
}
