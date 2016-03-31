<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Route\Match\Wildcard;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class WildcardTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke_no_wildcard()
    {
        $definition = new Definition([Arg::WILDCARD => false]);
        $route      = new Route;
        $wildcard   = new Wildcard;

        $this->assertEquals($route, $wildcard($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_valid_pair()
    {
        $definition = new Definition([Arg::WILDCARD => true]);
        $route      = new Route([Arg::PATH => '/foo/bar/baz/bat', Arg::PARAMS => ['a' => 'b'], Arg::LENGTH => 8]);
        $wildcard   = new Wildcard;

        $this->assertEquals(['a' => 'b', 'baz' => 'bat'], $wildcard($route, $definition)->params());
    }

    /**
     *
     */
    public function test_invoke_invalid_pair()
    {
        $definition = new Definition([Arg::WILDCARD => true]);
        $route      = new Route([Arg::PATH => '/foo/bar/baz', Arg::PARAMS => ['a' => 'b'], Arg::LENGTH => 8]);
        $wildcard   = new Wildcard;

        $this->assertEquals(['a' => 'b'], $wildcard($route, $definition)->params());
    }
}
