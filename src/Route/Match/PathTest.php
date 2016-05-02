<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class PathTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $definition = new Definition;
        $path       = new Path;
        $route      = new Route([Arg::PATH => 'foo']);

        $this->assertEquals($route, $path($route, $definition));
    }

    /**
     *
     */
    function test_invoke_not_matched()
    {
        $definition = new Definition([Arg::REGEX => 'bar']);
        $path       = new Path;
        $route      = new Route([Arg::PATH => 'foo']);

        $this->assertEquals(null, $path($route, $definition));
    }

    /**
     *
     */
    function test_params()
    {
        $path = new PathParams;

        $this->assertEquals(['bar' => 'baz'], $path->params(['foo' => 'bar'], ['foo' => 'baz']));
    }
}
