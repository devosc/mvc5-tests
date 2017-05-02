<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Middleware;
use Mvc5\Http\Request;
use Mvc5\Http\Request\Config as HttpRequest;
use Mvc5\Http\Response;
use Mvc5\Http\Response\Config as HttpResponse;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    function test_empty_stack_returns_response()
    {
        $middleware = new Middleware(new App);
        $request    = new HttpRequest;
        $response   = new HttpResponse;

        $this->assertEquals($response, $middleware($request, $response));
    }

    /**
     *
     */
    function test_reset()
    {
        $middleware = new Middleware(
            new App,
            [
                function(Request $request, Response $response, callable $next) {
                    return $next($request, $response);
                },
                function(Request $request, Response $response, callable $next) {
                    return $next($request, $response);
                }
            ]
        );

        $this->assertInstanceOf(Response::class, $middleware(new HttpRequest, new HttpResponse));
        $this->assertInstanceOf(Response::class, $middleware(new HttpRequest, new HttpResponse));
    }
}
