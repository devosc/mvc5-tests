<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Match\Action;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke_no_actions()
    {
        $action     = new Action;
        $definition = new Definition;
        $route      = new Route;

        $this->assertEquals($route, $action($route, $definition));
    }

    /**
     *
     */
    public function test__invoke_action()
    {
        $action     = new Action;
        $definition = new Definition([Arg::ACTION => ['GET' => 'foo']]);
        $route      = new Route([Arg::METHOD => 'GET']);

        /** @var Route $route */

        $route = $action($route, $definition);

        $this->assertEquals('foo', $route->controller());
    }

    /**
     *
     */
    public function test__invoke_no_action_default_is_controller()
    {
        $action     = new Action;
        $definition = new Definition;
        $route      = new Route([Arg::CONTROLLER => 'foo']);

        /** @var Route $route */

        $route = $action($route, $definition);

        $this->assertEquals('foo', $route->controller());
    }
}
