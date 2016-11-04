<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Merge;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class MergeTest
    extends TestCase
{
    /**
     *
     */
    function test_no_parent()
    {
        $method  = new Merge;
        $request = new Request;
        $route   = new Route;

        $this->assertEquals($request, $method($request, $route));
    }
    /**
     *
     */
    function test_merge_options()
    {
        $method  = new Merge;
        $parent  = new Route(['options' => ['prefix' => 'Foo\\']]);
        $request = new Request;
        $route   = new Route;

        $this->assertEquals($request, $method($request, $route, $parent));
        $this->assertEquals(['prefix' => 'Foo\\'], $route->options());
    }
}
