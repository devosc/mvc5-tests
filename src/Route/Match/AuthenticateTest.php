<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Http\Error\Unauthorized;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\Uri;
use Mvc5\Overload;
use Mvc5\Response\RedirectResponse;
use Mvc5\Route\Match\Authenticate;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class AuthenticateTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $request;
        };
    }

    /**
     *
     */
    function test()
    {
        $match = new Authenticate;
        $route = new Route;
        $request = new HttpRequest;

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_login_redirect()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest(['method' => 'GET', 'session' => new Overload, 'uri' => ['path' => '/']]);

        $response = $match($route, $request, $this->next());

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertInstanceOf(Uri::class, $request['session']['redirect_url']);
        $this->assertEquals(302, $response['status']);
        $this->assertEquals('/login', $response['headers']['location']);
    }

    /**
     *
     */
    function test_login_url()
    {
        $match = new Authenticate('/home');
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest(['method' => 'GET', 'session' => new Overload, 'uri' => ['path' => '/']]);

        $response = $match($route, $request, $this->next());

        $this->assertEquals('/home', $response['headers']['location']);
    }

    /**
     *
     */
    function test_no_authentication()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => false]);
        $request = new HttpRequest;

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_request_authenticated()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest(['authenticated' => true]);

        $this->assertEquals($request, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_request_not_authenticated()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest(['authenticated' => false]);

        $this->assertInstanceOf(Unauthorized::class, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_unauthorized()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest;

        $this->assertInstanceOf(Unauthorized::class, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_unauthorized_json_request()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest(['method' => 'GET', 'accepts_json' => true]);

        $this->assertInstanceOf(Unauthorized::class, $match($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_unauthorized_post_request()
    {
        $match = new Authenticate;
        $route = new Route(['authenticate' => true]);
        $request = new HttpRequest(['method' => 'POST']);

        $this->assertInstanceOf(Unauthorized::class, $match($route, $request, $this->next()));
    }
}
