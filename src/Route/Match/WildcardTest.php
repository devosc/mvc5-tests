<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Closure;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Wildcard;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ MATCHED, OPTIONS, PARAMS, WILDCARD };

final class WildcardTest
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
    function test_custom_name()
    {
        $route    = new Route([WILDCARD => true, OPTIONS => [WILDCARD => 'foobar']]);
        $request  = new HttpRequest([PARAMS => ['foobar'=> 'foo/bar/baz/bat']]);
        $wildcard = new Wildcard;

        $request = $wildcard($route, $request, $this->next());

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request[PARAMS]);
    }

    /**
     *
     */
    function test_empty_path()
    {
        $route    = new Route([WILDCARD => true]);
        $request  = new HttpRequest;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_invalid_path()
    {
        $route    = new Route([WILDCARD => true]);
        $request  = new HttpRequest([PARAMS => [WILDCARD => 'foo/bar/baz']]);
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_matched()
    {
        $route    = new Route([MATCHED => true]);
        $request  = new HttpRequest;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_no_wildcard()
    {
        $route    = new Route([WILDCARD => false]);
        $request  = new HttpRequest;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_param_exists()
    {
        $route    = new Route([WILDCARD => true]);
        $request  = new HttpRequest([PARAMS => [WILDCARD => 'foo/bar/baz/bat', 'foo' => 'foobar']]);
        $wildcard = new Wildcard;

        $request = $wildcard($route, $request, $this->next());

        $this->assertEquals(['foo' => 'foobar', 'baz' => 'bat'], $request[PARAMS]);
    }

    /**
     *
     */
    function test_valid_path()
    {
        $route    = new Route([WILDCARD => true]);
        $request  = new HttpRequest([PARAMS => [WILDCARD => 'foo/bar/baz/bat']]);
        $wildcard = new Wildcard;

        $request = $wildcard($route, $request, $this->next());

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request[PARAMS]);
    }
}
