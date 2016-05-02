<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Route\Definition\Add;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class AddTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $add = new Add;

        $parent = new Route;

        $route = new Route([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['/'];

        $this->assertInstanceOf(Route::class, $add($parent, $route, $path));
    }

    /**
     *
     */
    function test_invoke_start()
    {
        $add = new Add;

        $parent = new Route;

        $route = new Route([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => 'foo',
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['/'];

        $this->assertInstanceOf(Route::class, $add($parent, $route, $path, true));
    }

    /**
     *
     */
    function test_invoke_no_parent()
    {
        $add = new Add;

        $parent = new Route;

        $route = new Route([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['/', 'foo'];

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(Route::class, $add($parent, $route, $path));
    }

    /**
     *
     */
    function test_invoke_with_root()
    {
        $add = new Add;

        $parent = new Route([
            Arg::CHILDREN    => [
                'bar' => new Route
            ],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $route = new Route;

        $path = ['bar', 'baz'];

        $this->assertInstanceOf(Route::class, $add($parent, $route, $path));
    }
}
