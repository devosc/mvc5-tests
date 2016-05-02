<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Mvc\Route;
use Mvc5\Request\Config as Request;
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
                    return function(Request $request) {
                        switch($request->name()) {
                            default:
                                throw new \RuntimeException;
                                break;
                            case 'home':
                                $request[Arg::MATCHED] = true;
                                return $request;
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
    function test_invoke()
    {
        $route = new Route;

        $route->service($this->app());

        $this->assertInstanceOf(Request::class, $route(new Request([Arg::NAME => 'home'])));
    }

    /**
     *
     */
    function test_invoke_exception()
    {
        $route = new Route;

        $route->service($this->app());

        $this->assertEquals('foo', $route(new Request([Arg::NAME => 'exception'])));
    }
}
