<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Wildcard;
use Mvc5\Test\Test\TestCase;

class WildcardTest
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
    function test_custom_name()
    {
        $route    = new Route([Arg::WILDCARD => true, Arg::OPTIONS => [Arg::WILDCARD => 'foobar']]);
        $request  = new HttpRequest([Arg::PARAMS => ['foobar'=> 'foo/bar/baz/bat']]);
        $wildcard = new Wildcard;

        $request = $wildcard($route, $request, $this->next());

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_empty_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new HttpRequest;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_invalid_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new HttpRequest([Arg::PARAMS => [Arg::WILDCARD => 'foo/bar/baz']]);
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_matched()
    {
        $route    = new Route([Arg::MATCHED => true]);
        $request  = new HttpRequest;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_no_wildcard()
    {
        $route    = new Route([Arg::WILDCARD => false]);
        $request  = new HttpRequest;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_param_exists()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new HttpRequest([Arg::PARAMS => [Arg::WILDCARD => 'foo/bar/baz/bat', 'foo' => 'foobar']]);
        $wildcard = new Wildcard;

        $request = $wildcard($route, $request, $this->next());

        $this->assertEquals(['foo' => 'foobar', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_valid_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new HttpRequest([Arg::PARAMS => [Arg::WILDCARD => 'foo/bar/baz/bat']]);
        $wildcard = new Wildcard;

        $request = $wildcard($route, $request, $this->next());

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }
}
