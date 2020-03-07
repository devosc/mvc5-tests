<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    const ACTION = 'action';

    /**
     *
     */
    const CONTROLLER = 'controller';

    /**
     * @var array
     */
    protected $options = [
        Arg::PREFIX     => __NAMESPACE__ . '\\',
        Arg::SEPARATORS => ['_' => '_', '-' => '\\'],
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
        $route      = new Route([Arg::OPTIONS => $this->options]);
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'home', self::ACTION => 'view']]);

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\View\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_action_name_not_strict()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => $this->options]);
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'home-news', self::ACTION => 'show_latest']]);

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\News\Show_Latest\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_action_name_strict()
    {
        $options = [
            Arg::STRICT => true,
            Arg::SUFFIX => '\controller'
        ];

        $controller = new Controller(null, $options + $this->options);
        $route      = new Route;
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'foo', self::ACTION => 'bar']]);

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(foo\bar\controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_class_exists()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => [Arg::PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'home']]);

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_controller_exists()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new HttpRequest([Arg::CONTROLLER => 'foo']);

        $this->assertEquals($request, $controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_controller_not_found()
    {
        $controller = new Controller;
        $route      = new Route;
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'foo']]);

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
        $route      = new Route([Arg::OPTIONS => [Arg::PREFIX => __NAMESPACE__ . '\\']]);
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'home']]);

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertInstanceOf(Home\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_custom_action_and_controller_name()
    {
        $options = [
            Arg::ACTION     => 'bar',
            Arg::CONTROLLER => 'foo',
        ];

        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => $options + $this->options]);
        $request    = new HttpRequest([Arg::PARAMS => ['foo' => 'home', 'bar' => 'view']]);

        $this->assertNull($request[Arg::CONTROLLER]);

        $request = $controller($route, $request, $this->next());

        $this->assertEquals(Home\View\Controller::class, $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_invalid_action()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => $this->options]);
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => 'home', self::ACTION => '-_-']]);

        $this->assertNull($controller($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_invalid_controller()
    {
        $controller = new Controller;
        $route      = new Route([Arg::OPTIONS => $this->options]);
        $request    = new HttpRequest([Arg::PARAMS => [self::CONTROLLER => '-']]);

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
        $route      = new Route([Arg::MIDDLEWARE => ['a']]);
        $request    = new HttpRequest;

        $this->assertEquals($request, $controller($route, $request, $this->next()));
    }
}
