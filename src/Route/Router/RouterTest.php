<?php
/**
 *
 */

namespace Mvc5\Test\Route\Router;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Event;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Test\Test\TestCase;

class RouterTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        return new App([
            Arg::EVENTS => [
                'route\match' => [
                    function(Request $request, Route $route) {
                        switch($route->name()) {
                            default:
                                if ('baz' == $request->name()) {
                                    $request[Arg::MATCHED] = true;
                                }
                                return $request;
                                break;
                            case 'no_match':
                                return null;
                                break;
                            case 'matched':
                                $request[Arg::MATCHED] = true;
                                return $request;
                                break;
                        }
                    }
                ]
            ],
            Arg::SERVICES => [
                'route\match'     => Match::class,
                'route\generator' => Generator::class,
            ]
        ]);
    }

    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Router::class, new Router(new Route));
    }

    /**
     *
     */
    function test_routeDefinition()
    {
        $route  = new Route(['regex' => 'foo']);
        $router = new Router(new Route);

        $this->assertEquals($route, $router->routeDefinition($route));
    }

    /**
     *
     */
    function test_create_without_definition()
    {
        $router = new Router(new Route);

        $router->service($this->app());

        $this->assertInstanceOf(Route::class, $router->routeDefinition([Arg::ROUTE => '/']));
    }

    /**
     *
     */
    function test_dispatch_match_not_route()
    {
        $route   = new Route([Arg::NAME => 'no_match']);
        $request = new Request;

        $router = new Router(new Route);

        $router->service($this->app());

        $this->assertEquals(null, $router->dispatch($request, $route));
    }

    /**
     *
     */
    function test_dispatch_matched()
    {
        $route   = new Route([Arg::NAME => 'matched']);
        $request = new Request(new Mvc5Request);

        $router = new Router(new Route);

        $router->service($this->app());

        $result = new Mvc5Request([Arg::NAME => 'matched', Arg::MATCHED => true]);

        $this->assertEquals($result, $router->dispatch($request, $route));
    }

    /**
     *
     */
    function test_dispatch_with_children()
    {
        $route   = new Route([Arg::ROUTE => '/', Arg::CHILDREN => ['baz' => [Arg::ROUTE => 'foo']]]);
        $request = new Request(new Mvc5Request);

        $router = new Router(new Route);

        $router->service($this->app());

        $request = $router->dispatch($request, $route);

        $this->assertEquals('baz', $request->name());
    }

    /**
     *
     */
    function test_name()
    {
        $router = new Router(['name' => 'foo']);

        $this->assertEquals('foo', $router->name());
    }

    /**
     *
     */
    function test_invoke()
    {
        $router = new Router(new Route([Arg::ROUTE => '/']));

        $router->service($this->app());

        $this->assertEquals(null, $router(new Mvc5Request));
    }
}
