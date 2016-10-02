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
     *
     */
    function test_controller_exists()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new Request(new Mvc5Request([Arg::CONTROLLER => 'foo']));

        $this->assertEquals($request, $controller($request, $route));
    }

    /**
     *
     */
    function test_no_controller_param()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new Request(new Mvc5Request);

        $this->assertNull($controller($request, $route));
    }

    /**
     *
     */
    function test_invalid_controller()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => '-']]));

        $this->assertNull($controller($request, $route));
    }

    /**
     *
     */
    function test_invalid_action()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => 'home', Arg::ACTION => '-_-']]));

        $this->assertNull($controller($request, $route));
    }

    /**
     *
     */
    function test_controller_not_found()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => 'foo']]));

        $this->assertNull($controller($request, $route));
    }

    /**
     *
     */
    function test_controller_class_exists()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => [Arg::PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => 'home']]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertEquals(Home\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_service()
    {
        $class = __NAMESPACE__ . '\\Home\Controller';

        $loader = function($name) use($class) { return $class == $name ? new $class : null; };

        $controller = new Controller($loader);
        $route      = new Route([Arg::OPTIONS => [Arg::PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new Request(new Mvc5Request([Arg::PARAMS => [Arg::CONTROLLER => 'home']]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertInstanceOf(Home\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_action()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => [Arg::PREFIX => __NAMESPACE__ . '\\']]);
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
    function test_controller_action_name_strict()
    {
        $options = [
            Arg::PREFIX => __NAMESPACE__ . '\\',
            Arg::SUFFIX  => '\controller',
            Arg::STRICT  => true
        ];

        $controller = new Controller(null, $options);
        $route      = new Route;
        $request    = new Request(new Mvc5Request([
            Arg::PARAMS => [Arg::CONTROLLER => 'foo', Arg::ACTION => 'bar']
        ]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertEquals(foo\bar\controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_action_name_not_strict()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => [Arg::PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new Request(new Mvc5Request([
            Arg::PARAMS => [Arg::CONTROLLER => 'home-news', Arg::ACTION => 'show_latest']
        ]));

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($request, $route);

        $this->assertEquals(Home\News\Show_Latest\Controller::class, $request[Arg::CONTROLLER]);
    }
}
