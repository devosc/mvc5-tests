<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Closure;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Path;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ CHILDREN, MATCHED, PARAMS, PATH, REGEX, ROUTE, URI };

final class PathTest
    extends TestCase
{
    /**
     * @return Closure
     */
    protected function next() : Closure
    {
        return fn($route, $request) => $request;
    }

    /**
     *
     */
    function test_empty_route()
    {
        $route   = new Route;
        $path    = new Path;
        $request = new HttpRequest([URI => [PATH => 'foo']]);

        $this->assertNull($path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([REGEX => 'foo']);
        $path    = new Path;
        $request = new HttpRequest([URI => [PATH => 'foo']]);

        $new = $path($route, $request, $this->next());

        $this->assertNotEquals($request, $new);
        $this->assertTrue($new[MATCHED]);
        $this->assertNotNull($new[ROUTE]);
    }

    /**
     *
     */
    function test_match_named_params()
    {
        $config = [REGEX => '/(?P<controller>[a-zA-Z0-9]+)(?:/(?P<action>[a-zA-Z0-9]+$))?'];

        $route   = new Route($config);
        $path    = new Path;
        $request = new HttpRequest([URI => [PATH => '/home/foo']]);

        $new = $path($route, $request, $this->next());

        $this->assertTrue($new[MATCHED]);
        $this->assertEquals(['controller' => 'home', 'action' => 'foo'], $new[PARAMS]);
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([REGEX => 'bar']);
        $path    = new Path;
        $request = new HttpRequest([URI => [PATH => 'foo']]);

        $this->assertNull($path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_partial_match_with_child_routes()
    {
        $route   = new Route([REGEX => 'foo', CHILDREN => ['bar' => []]]);
        $path    = new Path;

        $request = new HttpRequest([URI => [PATH => 'foobar']]);

        $this->assertNull($request[ROUTE]);
        $this->assertNull($request[MATCHED]);

        $new = $path($route, $request, $this->next());

        $this->assertNotEquals($request, $new);
        $this->assertEquals(3, $new[MATCHED]);
        $this->assertNotNull($new[ROUTE]);
    }

    /**
     *
     */
    function test_partial_match_without_child_routes()
    {
        $route   = new Route([REGEX => 'foo']);
        $path    = new Path;
        $request = new HttpRequest([URI => [PATH => 'foobar']]);

        $this->assertNull($path($route, $request, $this->next()));
    }
}
