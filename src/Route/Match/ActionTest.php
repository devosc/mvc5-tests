<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\HttpRequest;
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
        return fn($route, $request) => $request;
    }

    /**
     *
     */
    function test_action()
    {
        $action  = new Action;
        $route   = new Route([Arg::ACTION => ['GET' => 'foo']]);
        $request = new HttpRequest([Arg::METHOD => 'GET']);

        /** @var HttpRequest $request */

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
        $request = new HttpRequest([Arg::CONTROLLER => 'foo']);

        /** @var HttpRequest $request */

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
        $request = new HttpRequest;

        $this->assertEquals($request, $action($route, $request, $this->next()));
    }
}
