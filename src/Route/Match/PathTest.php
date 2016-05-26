<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
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
    function test_invoke()
    {
        $route   = new Route;
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foo']]));

        $this->assertEquals($request, $path($request, $route));
    }

    /**
     *
     */
    function test_invoke_not_matched()
    {
        $route   = new Route([Arg::REGEX => 'bar']);
        $path    = new Path;
        $request = new Request(new Mvc5Request([Arg::URI => [Arg::PATH => 'foo']]));

        $this->assertEquals(null, $path($request, $route));
    }

    /**
     *
     */
    function test_params()
    {
        $path = new Params;

        $this->assertEquals(['bar' => 'baz'], $path->params(['foo' => 'bar'], ['foo' => 'baz']));
    }
}
