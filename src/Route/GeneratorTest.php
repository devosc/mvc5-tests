<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Generator;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    function test_route_array()
    {
        $route = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::OPTIONS     => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $generator = new Generator;

        $this->assertInstanceOf(Route::class, $generator($route));
    }

    /**
     *
     */
    function test_route_object()
    {
        $route = new Config([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::OPTIONS     => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ]);

        $generator = new Generator;

        $this->assertInstanceOf(Route::class, $generator($route));
    }
}
