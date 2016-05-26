<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\BadRequest;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Scheme;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class SchemeTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $route   = new Route;
        $request = new Request(new Mvc5Request);
        $scheme  = new Scheme;

        $this->assertEquals($request, $scheme($request, $route));
    }

    /**
     *
     */
    function test_invoke_matched()
    {
        $route   = new Route([Arg::SCHEME => 'http']);
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::SCHEME => 'http']]));
        $scheme  = new Scheme;

        $this->assertEquals($request, $scheme($request, $route));
    }

    /**
     *
     */
    function test_invoke_not_matched()
    {
        $route   = new Route([Arg::SCHEME => 'https']);
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::SCHEME => 'http']]));
        $scheme  = new Scheme;

        $this->assertInstanceOf(BadRequest::class, $scheme($request, $route));
    }
}
