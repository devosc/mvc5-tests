<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class MatchTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Match::class, new Match(new Definition, new Route));
    }

    /**
     *
     */
    function test_args()
    {
        $match = new Match(new Definition, new Route);

        $this->assertTrue(is_array($match->args()));
    }

    /**
     *
     */
    function test_invoke()
    {
        $match = new Match(new Definition, new Route);
        $route = new Route;

        $this->assertEquals($route, $match(function($route){ return $route; }, [Arg::ROUTE => $route]));
    }

    /**
     *
     */
    function test_invoke_not_route()
    {
        $match = new Match(new Definition, new Route);

        $this->assertEquals('foo', $match(function(){ return 'foo'; }));
    }
}
