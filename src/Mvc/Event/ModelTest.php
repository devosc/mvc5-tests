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
    function test_construct()
    {
        new Model(null, new Config);
    }

    /**
     *
     */
    function test_controller()
    {
        $model = new Model(null, [Arg::ROUTE => new Route([Arg::CONTROLLER => 'foo'])]);

        $this->assertEquals('foo', $model->controller());
    }

    /**
     *
     */
    function test_model()
    {
        $response = new Response;

        $response->setContent('foo');

        $model = new Model(null, [Arg::RESPONSE => $response]);

        $this->assertEquals('foo', $model->model());
    }

    /**
     *
     */
    function test_model_set()
    {
        $response = new Response;

        $model = new Model(null, [Arg::RESPONSE => $response]);

        $this->assertEquals('foo', $model->model('foo'));

        $this->assertEquals('foo', $response->content());
    }

    /**
     *
     */
    function test_response()
    {
        $model = new Model(null, [Arg::RESPONSE => new Response]);

        $this->assertEquals(new Response, $model->response());
    }

    /**
     *
     */
    function test_route()
    {
        $model = new Model(null, [Arg::ROUTE => new Route]);

        $this->assertEquals(new Route, $model->route());
    }

    /**
     *
     */
    function test_route_set()
    {
        $model = new Model(null, []);

        $this->assertEquals(new Route, $model->route(new Route));
    }
}
