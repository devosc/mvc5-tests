<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\App;
use Mvc5\Middleware;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;

final class MiddlewareTest
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
                fn(HttpRequest $request, HttpResponse $response, callable $next) => $next($request, $response),
                fn(HttpRequest $request, HttpResponse $response, callable $next) => $next($request, $response)
            ]
        );

        $this->assertInstanceOf(HttpResponse::class, $middleware(new HttpRequest, new HttpResponse));
        $this->assertInstanceOf(HttpResponse::class, $middleware(new HttpRequest, new HttpResponse));
    }
}
