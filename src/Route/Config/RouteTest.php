<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class RouteTest
    extends TestCase
{
    /**
     *
     */
    function test_controller()
    {
        $route = new Route([Arg::CONTROLLER => 'foo']);

        $this->assertEquals('foo', $route->controller());
    }

    /**
     *
     */
    function test_error()
    {
        $route = new Route([Arg::ERROR => 'foo']);;

        $this->assertEquals('foo', $route->error());
    }

    /**
     *
     */
    function test_hostname()
    {
        $route = new Route([Arg::HOSTNAME => 'foo']);

        $this->assertEquals('foo', $route->hostname());
    }

    /**
     *
     */
    function test_length()
    {
        $route = new Route([Arg::LENGTH => 2]);

        $this->assertEquals(2, $route->length());
    }

    /**
     *
     */
    function test_length_zero()
    {
        $route = new Route;

        $this->assertEquals(0, $route->length());
    }

    /**
     *
     */
    function test_matched()
    {
        $route = new Route([Arg::MATCHED => true]);

        $this->assertEquals(true, $route->matched());
    }

    /**
     *
     */
    function test_matched_false()
    {
        $route = new Route;

        $this->assertEquals(false, $route->matched());
    }

    /**
     *
     */
    function test_method()
    {
        $route = new Route([Arg::METHOD => 'foo']);

        $this->assertEquals('foo', $route->method());
    }

    /**
     *
     */
    function test_name()
    {
        $route = new Route([Arg::NAME => 'foo']);

        $this->assertEquals('foo', $route->name());
    }

    /**
     *
     */
    function test_param_not_null()
    {
        $route = new Route([Arg::PARAMS => ['foo' => 'bar']]);

        $this->assertEquals('bar', $route->param('foo'));
    }

    /**
     *
     */
    function test_param_null()
    {
        $route = new Route;

        $this->assertEquals(null, $route->param('foo'));
    }

    /**
     *
     */
    function test_params()
    {
        $route = new Route([Arg::PARAMS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->params());
    }

    /**
     *
     */
    function test_params_empty()
    {
        $route = new Route;

        $this->assertEquals([], $route->params());
    }

    /**
     *
     */
    function test_path()
    {
        $route = new Route([Arg::PATH => 'foo']);

        $this->assertEquals('foo', $route->path());
    }

    /**
     *
     */
    function test_port_exists()
    {
        $route = new Route([Arg::PORT => '80']);

        $this->assertEquals('80', $route->port());
    }

    /**
     *
     */
    function test_port_not_exists()
    {
        $route = new Route;

        $this->assertEquals(null, $route->port());
    }

    /**
     *
     */
    function test_scheme()
    {
        $route = new Route([Arg::SCHEME => 'foo']);

        $this->assertEquals('foo', $route->scheme());
    }
}
