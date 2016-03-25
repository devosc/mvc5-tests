<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Match\Method;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class MethodTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke_no_resources()
    {
        $method = new Method;

        $route = new Route;

        $definition = new Definition;

        $this->assertEquals($route, $method($route, $definition));
    }

    /**
     *
     */
    public function test__invoke_resource()
    {
        $method = new Method;

        $route = new Route([Arg::METHOD => 'GET']);

        $definition = new Definition([Arg::METHOD => ['GET' => 'foo']]);

        /** @var Route $route */

        $route = $method($route, $definition);

        $this->assertEquals('foo', $route->controller());
    }

    /**
     *
     */
    public function test__invoke_no_resource_existing_controller()
    {
        $resource = new Method;

        $route = new Route([Arg::CONTROLLER => 'foo']);

        $definition = new Definition;

        /** @var Route $route */

        $route = $resource($route, $definition);

        $this->assertEquals('foo', $route->controller());
    }
}
