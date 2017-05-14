<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\MethodNotAllowed;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Method;
use Mvc5\Test\Test\TestCase;

class MethodTest
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
    function test_matched()
    {
        $method  = new Method;
        $request = new HttpRequest([Arg::METHOD => 'GET']);
        $route   = new Route([Arg::METHOD => ['GET']]);

        $this->assertEquals($request, $method($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $method  = new Method;
        $request = new HttpRequest([Arg::METHOD => 'POST']);
        $route   = new Route([Arg::METHOD => 'GET']);

        $this->assertInstanceOf(MethodNotAllowed::class, $method($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_optional_match()
    {
        $method  = new Method;
        $request = new HttpRequest([Arg::METHOD => 'POST']);
        $route   = new Route([Arg::METHOD => 'GET', Arg::OPTIONAL => [Arg::METHOD]]);

        $this->assertNull($method($route, $request, $this->next()));
    }
}
