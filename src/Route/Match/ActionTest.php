<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Route\Match\Action;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $request;
        };
    }

    /**
     *
     */
    function test_action()
    {
        $action  = new Action;
        $route   = new Route([Arg::ACTION => ['GET' => 'foo']]);
        $request = new Request([Arg::METHOD => 'GET']);

        /** @var Request $request */

        $request = $action($route, $request, $this->next());

        $this->assertEquals('foo', $request->controller());
    }

    /**
     *
     */
    function test_no_action_default_is_controller()
    {
        $action  = new Action;
        $route   = new Route;
        $request = new Request([Arg::CONTROLLER => 'foo']);

        /** @var Request $request */

        $request = $action($route, $request, $this->next());

        $this->assertEquals('foo', $request->controller());
    }

    /**
     *
     */
    function test_no_actions()
    {
        $action  = new Action;
        $route   = new Route;
        $request = new Request;

        $this->assertEquals($request, $action($route, $request, $this->next()));
    }
}
