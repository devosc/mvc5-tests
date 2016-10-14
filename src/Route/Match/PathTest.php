<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Event;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class PathTest
    extends TestCase
{
    /**
     *
     */
    function test_empty_route()
    {
        $event   = new Event;
        $route   = new Route;
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foo']]));

        $this->assertNull($path($event, $request, $route));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $event   = new Event;
        $route   = new Route([Arg::REGEX => 'bar']);
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foo']]));

        $this->assertNull($path($event, $request, $route));
    }

    /**
     *
     */
    function test_matched()
    {
        $event   = new Event;
        $route   = new Route([Arg::REGEX => 'foo']);
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foo']]));

        $this->assertEquals($request, $path($event, $request, $route));
    }

    /**
     *
     */
    function test_partial_match_with_child_routes()
    {
        $event   = new Event;
        $route   = new Route([Arg::REGEX => 'foo', Arg::CHILDREN => ['bar' => []]]);
        $path    = new Path;

        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foobar']]));

        $this->assertFalse($event->stopped());
        $this->assertEquals($request, $path($event, $request, $route));
        $this->assertTrue($event->stopped());
    }

    /**
     *
     */
    function test_partial_match_without_child_routes()
    {
        $event   = new Event;
        $route   = new Route([Arg::REGEX => 'foo']);
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foobar']]));

        $this->assertNull($path($event, $request, $route));
    }

    /**
     *
     */
    function test_match_named_params()
    {
        $config = [Arg::REGEX => '/(?P<controller>[a-zA-Z0-9]+)(?:/(?P<action>[a-zA-Z0-9]+$))?'];

        $event   = new Event;
        $route   = new Route($config);
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => '/home/foo']]));

        $request = $path($event, $request, $route);

        $this->assertEquals(['controller' => 'home', 'action' => 'foo'], $request[Arg::PARAMS]);
    }
}
