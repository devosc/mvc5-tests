<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Merge;
use Mvc5\Test\Test\TestCase;

class MergeTest
    extends TestCase
{
    /**
     *
     */
    function test_no_parent()
    {
        $method = new Merge;
        $route  = new Route;

        $this->assertEquals($route, $method($route));
    }

    /**
     *
     */
    function test_merge_middleware()
    {
        $method = new Merge;
        $parent = new Route(['middleware' => ['a']]);
        $route  = new Route(['middleware' => ['b']]);

        $this->assertEquals($route, $method($route, $parent));
        $this->assertEquals(['a', 'b'], $route[Arg::MIDDLEWARE]);
    }

    /**
     *
     */
    function test_merge_options()
    {
        $method = new Merge;
        $parent = new Route(['options' => ['prefix' => 'Foo\\']]);
        $route  = new Route;

        $this->assertEquals($route, $method($route, $parent));
        $this->assertEquals(['prefix' => 'Foo\\'], $route->options());
    }
}
