<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class MatchTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Match::class, new Match(new Route, new Request(new Mvc5Request)));
    }

    /**
     *
     */
    function test_args()
    {
        $match = new Match(new Route, new Request(new Mvc5Request));

        $this->assertTrue(is_array($match->args()));
    }

    /**
     *
     */
    function test_invoke()
    {
        $match   = new Match(new Route, new Request(new Mvc5Request));
        $request = new Request(new Mvc5Request);

        $this->assertEquals($request, $match(function($request){ return $request; }, [Arg::REQUEST => $request]));
    }

    /**
     *
     */
    function test_invoke_not_route()
    {
        $match = new Match(new Route, new Request(new Mvc5Request));

        $this->assertEquals('foo', $match(function(){ return 'foo'; }));
    }
}
