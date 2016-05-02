<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Match\Action;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke_no_actions()
    {
        $action  = new Action;
        $route   = new Route;
        $request = new Request(new Mvc5Request);

        $this->assertEquals($request, $action($request, $route));
    }

    /**
     *
     */
    function test_invoke_action()
    {
        $action  = new Action;
        $route   = new Route([Arg::ACTION => ['GET' => 'foo']]);
        $request = new Request(new Mvc5Request([Arg::METHOD => 'GET']));

        /** @var Request $request */

        $request = $action($request, $route);

        $this->assertEquals('foo', $request->controller());
    }

    /**
     *
     */
    function test_invoke_no_action_default_is_controller()
    {
        $action  = new Action;
        $route   = new Route;
        $request = new Request(new Mvc5Request([Arg::CONTROLLER => 'foo']));

        /** @var Request $request */

        $request = $action($request, $route);

        $this->assertEquals('foo', $request->controller());
    }
}
