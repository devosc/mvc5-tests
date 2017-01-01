<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class MatchTest
    extends TestCase
{
    /**
     *
     */
    function test_route()
    {
        $route = new Route;
        $match = new Match;

        $this->assertEquals($route, $match(function($route){ return $route; }, [Arg::ROUTE => $route]));
    }

    /**
     *
     */
    function test_request()
    {
        $match   = new Match;
        $request = new Request;

        $this->assertEquals($request, $match(function($request){ return $request; }, [Arg::REQUEST => $request]));
    }

    /**
     *
     */
    function test_stopped()
    {
        $match = new Match;

        $this->assertEquals('foo', $match(function(){ return 'foo'; }));
        $this->assertTrue($match->stopped());
    }
}
