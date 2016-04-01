<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Test\Request\Request;
use Mvc5\Test\Response\Response;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Middleware::class, new Middleware([]));
    }

    /**
     *
     */
    public function test_next()
    {
        $middleware = new Middleware();

        $this->assertInstanceOf(\Closure::class, $middleware->next());
    }

    /**
     *
     */
    public function test_invoke_string_response()
    {
        $middleware = new Middleware([
            function(Request $request, Response $response, callable $next) {
                return 'foo';
            }
        ]);

        $middleware->service(new App);

        $this->assertEquals('foo', $middleware(new Request, new Response));
    }

    /**
     *
     */
    public function test_invoke_response()
    {
        $middleware = new Middleware([
            function(Request $request, Response $response, callable $next) {
                return $next($request, $response);
            }
        ]);

        $middleware->service(new App);

        $this->assertInstanceOf(Response::class, $middleware(new Request, new Response));
    }
}
