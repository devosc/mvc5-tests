<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Http\Error\Forbidden;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\CSRFToken;
use Mvc5\Test\Test\TestCase;

final class CSRFTokenTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return fn($route, $request) => $request;
    }

    /**
     *
     */
    function test_allow_safe_request_method()
    {
        $match = new CSRFToken;
        $route   = new Route;
        $request = new HttpRequest(['method' => 'GET']);

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_header_token()
    {
        $match = new CSRFToken;
        $route   = new Route;
        $request = new HttpRequest([
            'method' => 'POST', 'headers' => ['X-CSRF-Token' => 'foo'], 'session' => ['csrf_token' => 'foo']
        ]);

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_invalid_token()
    {
        $match = new CSRFToken;
        $route   = new Route;
        $request = new HttpRequest([
            'method' => 'POST', 'data' => ['csrf_token' => 'baz'], 'session' => ['csrf_token' => 'bat']
        ]);

        $this->assertInstanceOf(Forbidden::class, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_invalid_header_token()
    {
        $match = new CSRFToken;
        $route   = new Route;
        $request = new HttpRequest([
            'method' => 'POST', 'headers' => ['X-CSRF-Token' => 'foo'], 'session' => ['csrf_token' => 'bar']
        ]);

        $this->assertInstanceOf(Forbidden::class, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_route_configured_not_to_verify_token()
    {
        $match = new CSRFToken;
        $route   = new Route(['csr_token' => false]);
        $request = new HttpRequest(['method' => 'GET']);

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_token_does_not_exist()
    {
        $match = new CSRFToken;
        $route   = new Route;
        $request = new HttpRequest(['method' => 'POST', 'session' => ['csrf_token' => 'foo']]);

        $this->assertInstanceOf(Forbidden::class, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_token_is_verified_by_default()
    {
        $match = new CSRFToken;
        $route = new Route;
        $request = new HttpRequest([
            'method' => 'POST', 'data' => ['csrf_token' => 'foo'], 'session' => ['csrf_token' => 'foo']
        ]);

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_token_is_not_verified_by_default()
    {
        $match = new CSRFToken(false);
        $route   = new Route;
        $request = new HttpRequest;

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }
}
