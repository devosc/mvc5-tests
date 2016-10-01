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
    function test_invoke_matched()
    {
        $route    = new Route([Arg::MATCHED => true]);
        $request  = new Request;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_invoke_no_wildcard()
    {
        $route    = new Route([Arg::WILDCARD => false]);
        $request  = new Request;
        $wildcard = new Wildcard;

        $this->assertEquals($request, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_invoke_empty_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([Arg::URI => [Arg::PATH => '/foo/bar/'], Arg::LENGTH => 8]);
        $wildcard = new Wildcard;

        $this->assertEquals(null, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_invoke_invalid_path()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([Arg::URI => [Arg::PATH => '/foo/bar/a'], Arg::LENGTH => 8]);
        $wildcard = new Wildcard;

        $this->assertEquals(null, $wildcard($request, $route));
    }

    /**
     *
     */
    function test_invoke_valid_pair()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([
            Arg::URI => [Arg::PATH => '/foo/bar/baz/bat'], Arg::LENGTH => 8, Arg::PARAMS => ['a' => 'b']
        ]);
        $wildcard = new Wildcard;

        $request = $wildcard($request, $route);

        $this->assertEquals(['a' => 'b', 'baz' => 'bat'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_invoke_param_exists()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([
            Arg::URI => [Arg::PATH => '/foo/bar/baz/xyz/a/b'], Arg::LENGTH => 8, Arg::PARAMS => ['baz' => 'bat']
        ]);
        $wildcard = new Wildcard;

        $request = $wildcard($request, $route);

        $this->assertEquals(['baz' => 'bat', 'a' => 'b'], $request[Arg::PARAMS]);
    }
}
