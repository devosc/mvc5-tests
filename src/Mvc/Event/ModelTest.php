<?php
/**
 *
 */

namespace Mvc5\Test\Mvc\Event;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Test\Response\Response;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        new Model(null, new Config);
    }

    /**
     *
     */
    public function test_controller()
    {
        $model = new Model(null, [Arg::ROUTE => new Route([Arg::CONTROLLER => 'foo'])]);

        $this->assertEquals('foo', $model->controller());
    }

    /**
     *
     */
    public function test_model()
    {
        $model = new Model(null, [Arg::RESPONSE => new Response]);

        $this->assertEquals('foo', $model->model());
    }

    /**
     *
     */
    public function test_model_set()
    {
        $model = new Model(null, [Arg::RESPONSE => new Response]);

        $this->assertEquals('foo', $model->model('foo'));
    }

    /**
     *
     */
    public function test_response()
    {
        $model = new Model(null, [Arg::RESPONSE => new Response]);

        $this->assertEquals(new Response, $model->response());
    }

    /**
     *
     */
    public function test_route()
    {
        $model = new Model(null, [Arg::ROUTE => new Route]);

        $this->assertEquals(new Route, $model->route());
    }

    /**
     *
     */
    public function test_route_set()
    {
        $model = new Model(null, []);

        $this->assertEquals(new Route, $model->route(new Route));
    }
}
