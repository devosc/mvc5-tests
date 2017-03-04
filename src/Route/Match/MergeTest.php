<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Merge;
use Mvc5\Test\Test\TestCase;

class MergeTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $route;
        };
    }

    /**
     *
     */
    function test_merge_middleware()
    {
        $method  = new Merge;
        $request = new Request;
        $route   = new Route(['parent' => new Route(['middleware' => ['a']]),'middleware' => ['b']]);

        $this->assertEquals($route, $method($route, $request, $this->next()));
        $this->assertEquals(['a', 'b'], $route[Arg::MIDDLEWARE]);
    }

    /**
     *
     */
    function test_merge_options()
    {
        $method  = new Merge;
        $request = new Request;
        $route   = new Route(['parent' => new Route(['options' => ['prefix' => 'Foo\\']])]);

        $this->assertEquals($route, $method($route, $request, $this->next()));
        $this->assertEquals(['prefix' => 'Foo\\'], $route->options());
    }

    /**
     *
     */
    function test_no_parent()
    {
        $method  = new Merge;
        $request = new Request;
        $route   = new Route;

        $this->assertEquals($route, $method($route, $request, $this->next()));
    }
}
