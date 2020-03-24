<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Closure;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Match\Action;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ ACTION, CONTROLLER, METHOD };

class ActionTest
    extends TestCase
{
    /**
     * @return Closure
     */
    protected function next() : Closure
    {
        return fn($route, $request) => $request;
    }

    /**
     *
     */
    function test_action()
    {
        $action  = new Action;
        $route   = new Route([ACTION => ['GET' => 'foo']]);
        $request = new HttpRequest([METHOD => 'GET']);

        /** @var HttpRequest $request */

        $request = $action($route, $request, $this->next());

        $this->assertEquals('foo', $request->controller());
    }

    /**
     *
     */
    function test_action_head()
    {
        $action  = new Action;
        $route   = new Route([ACTION => ['HEAD' => 'foo']]);
        $request = new HttpRequest([METHOD => 'HEAD']);

        /** @var HttpRequest $request */

        $request = $action($route, $request, $this->next());

        $this->assertEquals('foo', $request->controller());
    }

    /**
     *
     */
    function test_action_head_with_get()
    {
        $action  = new Action;
        $route   = new Route([ACTION => ['GET' => 'foo']]);
        $request = new HttpRequest([METHOD => 'HEAD']);

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
        $request = new HttpRequest([CONTROLLER => 'foo', METHOD => 'GET']);

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
        $request = new HttpRequest([METHOD => 'GET']);

        $this->assertEquals($request, $action($route, $request, $this->next()));
    }
}
