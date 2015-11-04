<?php

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Base as BaseMvc;
use Mvc5\Response\Response;
use Mvc5\Route\Route;

class Base
{
    use BaseMvc;

    /**
     * @return callable|object|null|string
     */
    public function testController()
    {
        return $this->controller();
    }

    /**
     * @return array|callable|null|object|string
     */
    public function testModel()
    {
        return $this->model();
    }

    /**
     * @return Response
     */
    public function testResponse()
    {
        return $this->response();
    }

    /**
     * @return Route
     */
    public function testRoute()
    {
        return $this->route();
    }

    /**
     * @param $model
     * @return void
     */
    public function testSetModel($model)
    {
        $this->setModel($model);
    }

    /**
     * @param Response $response
     * @return void
     */
    public function testSetResponse(Response $response)
    {
        $this->setResponse($response);
    }

    /**
     * @param Route $route
     * @return void
     */
    public function testSetRoute(Route $route)
    {
        $this->setRoute($route);
    }
}
