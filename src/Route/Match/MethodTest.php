<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Http\Error\MethodNotAllowed;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Method;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ METHOD, OPTIONAL };

final class MethodTest
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
    function test_matched()
    {
        $method  = new Method;
        $request = new HttpRequest([METHOD => 'GET']);
        $route   = new Route([METHOD => ['GET']]);

        $this->assertEquals($request, $method($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_matched_head()
    {
        $method  = new Method;
        $request = new HttpRequest([METHOD => 'HEAD']);
        $route   = new Route([METHOD => ['GET']]);

        $this->assertEquals($request, $method($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $method  = new Method;
        $request = new HttpRequest([METHOD => 'POST']);
        $route   = new Route([METHOD => 'GET']);

        $this->assertInstanceOf(MethodNotAllowed::class, $method($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_not_matched_head()
    {
        $method  = new Method;
        $request = new HttpRequest([METHOD => 'HEAD']);
        $route   = new Route([METHOD => 'POST']);

        $this->assertInstanceOf(MethodNotAllowed::class, $method($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_optional_match()
    {
        $method  = new Method;
        $request = new HttpRequest([METHOD => 'POST']);
        $route   = new Route([METHOD => 'GET', OPTIONAL => [METHOD]]);

        $this->assertNull($method($route, $request, $this->next()));
    }
}
