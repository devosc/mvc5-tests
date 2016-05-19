<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Request as HttpRequest;
use Mvc5\Http\Response as HttpResponse;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Middleware;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $plugin = new Middleware('foo');

        $this->assertEquals([$plugin, 'next'], $plugin->config());
        $this->assertEquals([new Link, 'foo'], $plugin->args());
    }

    /**
     *
     */
    function test_next_request()
    {
        $plugin = new Middleware('foo');

        $middleware = $plugin->next(new App, function() { return new Request(['foo' => 'bar']); });

        $result = $middleware(new Request, new Response, function($request, $response) { return $request['foo']; });

        $this->assertEquals('bar', $result);
    }

    /**
     *
     */
    function test_next_response()
    {
        $plugin = new Middleware('foo');

        $middleware = $plugin->next(new App, function() { return new Response(['body' => 'foo']); });

        $result = $middleware(new Request, new Response, function($request, $response) { return $response['body']; });

        $this->assertEquals('foo', $result);
    }

    /**
     *
     */
    function test_next_no_request_or_response()
    {
        $plugin = new Middleware('foo');

        $middleware = $plugin->next(new App, function() { });

        $result = $middleware(new Request, new Response, function($request, $response) { return 'foo'; });

        $this->assertEquals('foo', $result);
    }
}
