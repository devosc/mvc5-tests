<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Match\Controller;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     * @return array
     */
    protected function routeActionConfig()
    {
        return [
            Arg::OPTIONS => [
                Arg::PREFIX => __NAMESPACE__ . '\\',
                Arg::SEPARATORS => ['-' => '\\', '_' => '_'],
                Arg::SUFFIX     => '\Controller',
                Arg::SPLIT      => '\\'
            ]
        ];
    }

    /**
     *
     */
    function test_invoke_controller_exists()
    {
        $controller = new Controller;
        $route      = new Route($this->routeActionConfig());
        $request    = new Request(new Mvc5Request([Arg::CONTROLLER => 'foo']));

        $this->assertEquals($request, $controller($request, $route));
    }

    /**
     *
     */
    function test_invoke_controller_not_found()
    {
        $controller = new Controller;
        $route      = new Route($this->routeActionConfig());
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => 'foo']]));

        $this->assertNull($controller($request, $route));
    }

    /**
     *
     */
    function test_invoke_controller_found()
    {
        $controller = new Controller;
        $route      = new Route($this->routeActionConfig());
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => 'home']]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertEquals(Home\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_invoke_controller_action_found()
    {
        $controller = new Controller;
        $route      = new Route($this->routeActionConfig());
        $request    = new Request(new Mvc5Request([
            Arg::PARAMS => [Arg::CONTROLLER => 'home', Arg::ACTION => 'view']
        ]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertEquals(Home\View\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_invoke_controller_action_name()
    {
        $controller = new Controller;
        $route      = new Route($this->routeActionConfig());
        $request    = new Request(new Mvc5Request([
            Arg::PARAMS => [Arg::CONTROLLER => 'home-news', Arg::ACTION => 'show_latest']
        ]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertEquals(Home\News\Show_Latest\Controller::class, $request[Arg::CONTROLLER]);
    }
}
