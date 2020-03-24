<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Http\Error\NotFound;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Controller;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ ACTION, CONTROLLER, MIDDLEWARE, OPTIONS, PARAMS, PREFIX, SEPARATORS, STRICT, SUFFIX };

class ControllerTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $options = [
        PREFIX     => __NAMESPACE__ . '\\',
        SEPARATORS => ['_' => '_', '-' => '\\'],
    ];

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
    function test_controller_action()
    {
        $controller = new Controller;
        $route      = new Route([OPTIONS => $this->options]);
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'home', ACTION => 'view']]);

        $this->assertNull($request[CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\View\Controller::class, $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_action_name_not_strict()
    {
        $controller = new Controller;
        $route      = new Route([OPTIONS => $this->options]);
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'home-news', ACTION => 'show_latest']]);

        $this->assertNull($request[CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\News\Show_Latest\Controller::class, $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_action_name_strict()
    {
        $options = [
            STRICT => true,
            SUFFIX => '\controller'
        ];

        $controller = new Controller(null, $options + $this->options);
        $route      = new Route;
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'foo', ACTION => 'bar']]);

        $this->assertNull($request[CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(foo\bar\controller::class, $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_class_exists()
    {
        $controller = new Controller;
        $route      = new Route([OPTIONS => [PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'home']]);

        $this->assertNull($request[CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\Controller::class, $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_exists()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new HttpRequest([CONTROLLER => 'foo']);

        $this->assertEquals($request, $controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_controller_not_found()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'foo']]);

        $this->assertEquals(new NotFound, $controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_controller_service()
    {
        $class = __NAMESPACE__ . '\\Home\Controller';

        $loader = fn($name) => $class == $name ? new $class : null;

        $controller = new Controller($loader);
        $route      = new Route([OPTIONS => [PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'home']]);

        $this->assertNull($request[CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertInstanceOf(Home\Controller::class, $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_custom_action_and_controller_name()
    {
        $options = [
            ACTION     => 'bar',
            CONTROLLER => 'foo',
        ];

        $controller = new Controller;
        $route      = new Route([OPTIONS => $options + $this->options]);
        $request    = new HttpRequest([PARAMS => ['foo' => 'home', 'bar' => 'view']]);

        $this->assertNull($request[CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\View\Controller::class, $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_invalid_action()
    {
        $controller = new Controller;
        $route      = new Route([OPTIONS => $this->options]);
        $request    = new HttpRequest([PARAMS => [CONTROLLER => 'home', ACTION => '-_-']]);

        $this->assertNull($controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_invalid_controller()
    {
        $controller = new Controller;
        $route      = new Route([OPTIONS => $this->options]);
        $request    = new HttpRequest([PARAMS => [CONTROLLER => '-']]);

        $this->assertNull($controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_no_controller_param()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new HttpRequest;

        $this->assertNull($controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_middleware_and_no_controller_param()
    {
        $controller = new Controller;
        $route      = new Route([MIDDLEWARE => ['a']]);
        $request    = new HttpRequest;

        $this->assertEquals($request, $controller($route, $request, $this->next()));
    }
}
