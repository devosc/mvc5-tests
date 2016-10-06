<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Wildcard;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class WildcardTest
    extends TestCase
{
    /**
     *
     */
    function test_matched()
    {
        $route    = new Route([Arg::MATCHED => true]);
        $request  = new Request;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_no_wildcard()
    {
        $route    = new Route([Arg::WILDCARD => false]);
        $request  = new Request;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_empty_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_invalid_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([Arg::PARAMS => [Arg::WILDCARD => 'foo/bar/baz']]);
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_valid_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([Arg::PARAMS => [Arg::WILDCARD => 'foo/bar/baz/bat']]);
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));

        $request = $wildcard($request, $route);

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_param_exists()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([Arg::PARAMS => [Arg::WILDCARD => 'foo/bar/baz/bat', 'foo' => 'foobar']]);
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));

        $request = $wildcard($request, $route);

        $this->assertEquals(['foo' => 'foobar', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_custom_name()
    {
        $route    = new Route([Arg::WILDCARD => true, Arg::OPTIONS => [Arg::WILDCARD => 'foobar']]);
        $request  = new Request([Arg::PARAMS => ['foobar'=> 'foo/bar/baz/bat']]);
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));

        $request = $wildcard($request, $route);

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }
}
