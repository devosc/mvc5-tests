<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Host;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class HostTest
    extends TestCase
{
    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([Arg::HOST => 'foo']);
        $host    = new Host;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::HOST => 'foo']]));

        $this->assertEquals($request, $host($request, $route));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([Arg::HOST => 'foo']);
        $host    = new Host;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::HOST => 'bar']]));

        $this->assertInstanceOf(NotFound::class, $host($request, $route));
    }

    /**
     *
     */
    function test_optional()
    {
        $route   = new Route([Arg::HOST => 'foo', Arg::OPTIONAL => ['host']]);
        $host    = new Host;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::HOST => 'bar']]));

        $this->assertEquals(null, $host($request, $route));
    }
}
