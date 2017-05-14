<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Path;
use Mvc5\Test\Test\TestCase;

class PathTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $request;
        };
    }

    /**
     *
     */
    function test_empty_route()
    {
        $route   = new Route;
        $path    = new Path;
        $request = new HttpRequest([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertNull($path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([Arg::REGEX => 'foo']);
        $path    = new Path;
        $request = new HttpRequest([Arg::URI => [Arg::PATH => 'foo']]);

        $new = $path($route, $request, $this->next());

        $this->assertNotEquals($request, $new);
        $this->assertTrue($new[Arg::MATCHED]);
        $this->assertNotNull($new[Arg::ROUTE]);
    }

    /**
     *
     */
    function test_match_named_params()
    {
        $config = [Arg::REGEX => '/(?P<controller>[a-zA-Z0-9]+)(?:/(?P<action>[a-zA-Z0-9]+$))?'];

        $route   = new Route($config);
        $path    = new Path;
        $request = new HttpRequest([Arg::URI => [Arg::PATH => '/home/foo']]);

        $new = $path($route, $request, $this->next());

        $this->assertTrue($new[Arg::MATCHED]);
        $this->assertEquals(['controller' => 'home', 'action' => 'foo'], $new[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([Arg::REGEX => 'bar']);
        $path    = new Path;
        $request = new HttpRequest([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertNull($path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_partial_match_with_child_routes()
    {
        $route   = new Route([Arg::REGEX => 'foo', Arg::CHILDREN => ['bar' => []]]);
        $path    = new Path;

        $request = new HttpRequest([Arg::URI => [Arg::PATH => 'foobar']]);

        $this->assertNull($request[Arg::ROUTE]);
        $this->assertNull($request[Arg::MATCHED]);

        $new = $path($route, $request, $this->next());

        $this->assertNotEquals($request, $new);
        $this->assertEquals(3, $new[Arg::MATCHED]);
        $this->assertNotNull($new[Arg::ROUTE]);
    }

    /**
     *
     */
    function test_partial_match_without_child_routes()
    {
        $route   = new Route([Arg::REGEX => 'foo']);
        $path    = new Path;
        $request = new HttpRequest([Arg::URI => [Arg::PATH => 'foobar']]);

        $this->assertNull($path($route, $request, $this->next()));
    }
}
