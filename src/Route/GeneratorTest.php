<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Config;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Generator;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ CHILDREN, CONSTRAINTS, NAME, OPTIONS, PATH, REGEX, TOKENS };

final class GeneratorTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test_route_array()
    {
        $route = [
            CHILDREN    => [],
            CONSTRAINTS => [],
            NAME        => null,
            OPTIONS     => [],
            PATH        => '/',
            REGEX       => null,
            TOKENS      => null
        ];

        $generator = new Generator;

        $this->assertInstanceOf(Route::class, $generator($route));
    }

    /**
     * @throws \Throwable
     */
    function test_route_object()
    {
        $route = new Config([
            CHILDREN    => [],
            CONSTRAINTS => [],
            NAME        => null,
            OPTIONS     => [],
            PATH        => '/',
            REGEX       => null,
            TOKENS      => null
        ]);

        $generator = new Generator;

        $this->assertInstanceOf(Route::class, $generator($route));
    }
}
