<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\MethodNotAllowed;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Method;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class MethodTest
    extends TestCase
{
    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([Arg::METHOD => ['GET']]);
        $method  = new Method;
        $request = new Request(new Mvc5Request([Arg::METHOD => 'GET']));

        $this->assertEquals($request, $method($request, $route));
    }

    /**
     *
     */
    function test_optional_match()
    {
        $route   = new Route([Arg::METHOD => 'GET', Arg::OPTIONAL => [Arg::METHOD]]);
        $method  = new Method;
        $request = new Request(new Mvc5Request([Arg::METHOD => 'POST']));

        $this->assertNull($method($request, $route));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([Arg::METHOD => 'GET']);
        $method  = new Method;
        $request = new Request(new Mvc5Request([Arg::METHOD => 'POST']));

        $this->assertInstanceOf(MethodNotAllowed::class, $method($request, $route));
    }
}
