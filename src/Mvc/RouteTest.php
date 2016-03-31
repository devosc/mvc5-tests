<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Mvc\Route;
use Mvc5\Route\Config as RouteConfig;
use Mvc5\Test\Test\TestCase;

class RouteTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        return new App([
            Arg::SERVICES => [
                'route\dispatch' => function() {
                    return function(RouteConfig $route) {
                        switch($route->name()) {
                            default:
                                throw new \RuntimeException;
                                break;
                            case 'home':
                                $route[Arg::MATCHED] = true;
                                return $route;
                                break;
                        }
                    };
                },
                'route\exception' => function() {
                    return function() {
                      return 'foo';
                    };
                }
            ]
        ]);
    }

    /**
     *
     */
    public function test_invoke()
    {
        $route = new Route;

        $route->service($this->app());

        $this->assertInstanceOf(RouteConfig::class, $route(new RouteConfig([Arg::NAME => 'home'])));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $route = new Route;

        $route->service($this->app());

        $this->assertEquals('foo', $route(new RouteConfig([Arg::NAME => 'exception'])));
    }
}
