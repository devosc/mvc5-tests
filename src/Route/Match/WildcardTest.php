<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Match\Wildcard;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class WildcardTest
    extends TestCase
{
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
    function test_invoke_invalid_pair()
    {
        $route    = new Route([Arg::WILDCARD => true]);
        $request  = new Request([
            Arg::URI => [Arg::PATH => '/foo/bar/baz'], Arg::LENGTH => 8, Arg::PARAMS => ['a' => 'b']
        ]);
        $wildcard = new Wildcard;

        $request = $wildcard($request, $route);

        $this->assertEquals(['a' => 'b'], $request[Arg::PARAMS]);
    }
}
