<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Generator;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $route = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $generator = new Generator;

        $this->assertInstanceOf(Route::class, $generator($route));
    }
}
