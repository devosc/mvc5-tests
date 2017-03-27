<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class RouteTest
    extends TestCase
{
    /**
     *
     */
    function test_action()
    {
        $route = new Route([Arg::ACTION => ['GET' => 'foo']]);

        $this->assertEquals('foo', $route->action('GET'));
    }

    /**
     *
     */
    function test_actions()
    {
        $route = new Route([Arg::ACTION => ['GET' => 'foo']]);

        $this->assertEquals(['GET' => 'foo'], $route->action());
    }

    /**
     *
     */
    function test_child_exists()
    {
        $route = new Route([Arg::CHILDREN => ['bar' => ['name' => 'baz']]]);

        $this->assertEquals(['name' => 'baz'], $route->child('bar'));
    }

    /**
     *
     */
    function test_children_isset()
    {
        $route = new Route([Arg::CHILDREN => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->children());
    }

    /**
     *
     */
    function test_child_not_exists()
    {
        $route = new Route;

        $this->assertNull($route->child('bar'));
    }

    /**
     *
     */
    function test_children_not_isset()
    {
        $route = new Route;

        $this->assertEquals([], $route->children());
    }

    /**
     *
     */
    function test_constraints_exists()
    {
        $route = new Route([Arg::CONSTRAINTS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->constraints());
    }

    /**
     *
     */
    function test_constraints_not_exists()
    {
        $route = new Route;

        $this->assertEquals([], $route->constraints());
    }

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
    function test_defaults_exists()
    {
        $route = new Route(['defaults' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->defaults());
    }

    /**
     *
     */
    function test_defaults_not_exists()
    {
        $route = new Route;

        $this->assertEquals([], $route->defaults());
    }

    /**
     *
     */
    function test_host_exists()
    {
        $route = new Route(['host' => 'foo']);

        $this->assertEquals('foo', $route->host());
    }

    /**
     *
     */
    function test_host_not_exists()
    {
        $route = new Route;

        $this->assertNull($route->host());
    }

    /**
     *
     */
    function test_method_exists()
    {
        $route = new Route([Arg::METHOD => 'foo']);

        $this->assertEquals('foo', $route->method());
    }

    /**
     *
     */
    function test_method_not_exists()
    {
        $route = new Route;

        $this->assertNull($route->method());
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
    function test_options_exists()
    {
        $route = new Route([Arg::OPTIONS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->options());
    }

    /**
     *
     */
    function test_options_not_exists()
    {
        $route = new Route;

        $this->assertEquals([], $route->options());
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

        $this->assertNull($route->port());
    }

    /**
     *
     */
    function test_regex()
    {
        $route = new Route([Arg::REGEX => 'foo']);

        $this->assertEquals('foo', $route->regex());
    }

    /**
     *
     */
    function test_scheme()
    {
        $route = new Route([Arg::SCHEME => 'foo']);

        $this->assertEquals('foo', $route->scheme());
    }

    /**
     *
     */
    function test_tokens_exists()
    {
        $route = new Route([Arg::TOKENS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->tokens());
    }

    /**
     *
     */
    function test_tokens_not_exists()
    {
        $route = new Route;

        $this->assertEquals([], $route->tokens());
    }

    /**
     *
     */
    function test_wildcard_exists()
    {
        $route = new Route([Arg::WILDCARD => 'foo']);

        $this->assertEquals('foo', $route->wildcard());
    }

    /**
     *
     */
    function test_wildcard_not_exists()
    {
        $route = new Route;

        $this->assertFalse($route->wildcard());
    }
}
