<?php
/**
 *
 */

namespace Mvc5\Test\Mvc\Event;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Test\Response\Response;
use Mvc5\Request\Config as Request;
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
        $model = new Model(null, [Arg::REQUEST => new Request([Arg::CONTROLLER => 'foo'])]);

        $this->assertEquals('foo', $model->controller());
    }

    /**
     *
     */
    function test_model()
    {
        $model = new Model(null, [Arg::RESPONSE => new Response('foo')]);

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

        $this->assertEquals('foo', $response->body());
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
    function test_request()
    {
        $model = new Model(null, [Arg::REQUEST => new Request]);

        $this->assertEquals(new Request, $model->request());
    }

    /**
     *
     */
    function test_request_set()
    {
        $model = new Model(null, []);

        $this->assertEquals(new Request, $model->request(new Request));
    }
}
