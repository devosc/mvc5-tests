<?php
/**
 *
 */

namespace Mvc5\Test\Route\Router;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Event;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
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
                    function(Route $route, Definition $definition) {
                        switch($definition->name()) {
                            default:
                                if ('baz' == $route->name()) {
                                    $route[Arg::MATCHED] = true;
                                }
                                return $route;
                                break;
                            case 'no_match':
                                return null;
                                break;
                            case 'matched':
                                $route[Arg::MATCHED] = true;
                                return $route;
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
    public function test_construct()
    {
        $this->assertInstanceOf(Router::class, new Router(new Definition));
    }

    /**
     *
     */
    public function test_routeDefinition()
    {
        $definition = new Definition(['regex' => 'foo']);
        $router     = new Router(new Definition);

        $this->assertEquals($definition, $router->routeDefinition($definition));
    }

    /**
     *
     */
    public function test_create_without_definition()
    {
        $router = new Router(new Definition);

        $router->service($this->app());

        $this->assertInstanceOf(Definition::class, $router->routeDefinition([Arg::ROUTE => '/']));
    }

    /**
     *
     */
    public function test_dispatch_match_not_route()
    {
        $definition = new Definition([Arg::NAME => 'no_match']);
        $route      = new Route;

        $router = new Router(new Definition);

        $router->service($this->app());

        $this->assertEquals(null, $router->dispatch($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_matched()
    {
        $definition = new Definition([Arg::NAME => 'matched']);
        $route      = new Route;

        $router = new Router(new Definition);

        $router->service($this->app());

        $this->assertEquals($route, $router->dispatch($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_with_children()
    {
        $definition = new Definition([Arg::ROUTE => '/', Arg::CHILDREN => ['baz' => [Arg::ROUTE => 'foo']]]);
        $route      = new Route;

        $router = new Router(new Definition);

        $router->service($this->app());

        $route = $router->dispatch($route, $definition);

        $this->assertEquals('baz', $route->name());
    }

    /**
     *
     */
    public function test_name()
    {
        $router = new Router(['name' => 'foo']);

        $this->assertEquals('foo', $router->name());
    }

    /**
     *
     */
    public function test_invoke()
    {
        $router = new Router(new Definition([Arg::ROUTE => '/']));

        $router->service($this->app());

        $this->assertEquals(null, $router(new Route));
    }
}
