<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\App;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match;
use Mvc5\Test\Test\TestCase;

class MatchTest
    extends TestCase
{
    /**
     *
     */
    function test_empty_stack_returns_request()
    {
        $middleware = new Match(new App);
        $request    = new HttpRequest;
        $route      = new Route;

        $this->assertEquals($request, $middleware($route, $request));
    }

    /**
     *
     */
    function test_reset()
    {
        $middleware = new Match(
            new App,
            [
                function(Route $route, HttpRequest $request, callable $next) {
                    return $next($route, $request);
                },
                function(Route $route, HttpRequest $request, callable $next) {
                    return $next($route, $request);
                }
            ]
        );

        $this->assertInstanceOf(HttpRequest::class, $middleware(new Route, new HttpRequest));
        $this->assertInstanceOf(HttpRequest::class, $middleware(new Route, new HttpRequest));
    }
}
