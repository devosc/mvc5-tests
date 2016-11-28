<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Middleware;
use Mvc5\Request\Config as Request;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    function test_empty_stack_with_next()
    {
        $middleware = new Middleware;
        $request    = new Request;
        $response   = new Response;

        $next = function($request, $response) {
            return 'foo';
        };

        $this->assertEquals('foo', $middleware($request, $response, $next));
    }

    /**
     *
     */
    function test_empty_stack_without_next_returns_response()
    {
        $middleware = new Middleware;
        $request    = new Request;
        $response   = new Response;

        $this->assertEquals($response, $middleware($request, $response));
    }

    /**
     *
     */
    function test_pipe()
    {
        $next = function($request, $response) {
            return 'foo';
        };

        $middleware = new Middleware([
            function(Request $request, Response $response, callable $next) {
                return $next($request, $response);
            }
        ]);

        $middleware->service(new App);

        $this->assertEquals('foo', $middleware(new Request, new Response, $next));
    }

    /**
     *
     */
    function test_no_pipe_returns_response()
    {
        $middleware = new Middleware([
            function(Request $request, Response $response, callable $next) {
                return $next($request, $response);
            }
        ]);

        $middleware->service(new App);

        $this->assertInstanceOf(Response::class, $middleware(new Request, new Response));
    }


    /**
     *
     */
    function test_reset()
    {
        $middleware = new Middleware([
            function(Request $request, Response $response, callable $next) {
                return $next($request, $response);
            },
            function(Request $request, Response $response, callable $next) {
                return $next($request, $response);
            }
        ]);

        $middleware->service(new App);

        $this->assertInstanceOf(Response::class, $middleware(new Request, new Response));
        $this->assertInstanceOf(Response::class, $middleware(new Request, new Response));
    }
}
