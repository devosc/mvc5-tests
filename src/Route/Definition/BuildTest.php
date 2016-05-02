<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Route\Route;
use Mvc5\Route\Config;
use Mvc5\Test\Test\TestCase;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    function test_definition()
    {
        $build = new Build;

        $route = [
            Arg::CHILDREN    => ['foo' => [Arg::ROUTE => 'foo']],
            Arg::CONSTRAINTS => null,
            Arg::NAME        => null,
            Arg::MAP         => null,
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInternalType('array', $build->definition($route, true, true));
    }

    /**
     *
     */
    function test_definition_no_route_exception()
    {
        $build = new Build;

        $this->setExpectedException('RuntimeException');

        $build->definition([]);
    }

    /**
     *
     */
    function test_children()
    {
        $build = new Build;

        $routes = [
            [
                Arg::CHILDREN    => [],
                Arg::CONSTRAINTS => [],
                Arg::NAME        => null,
                Arg::MAP         => [],
                Arg::REGEX       => null,
                Arg::ROUTE       => '/',
                Arg::TOKENS      => null
            ]
        ];

        $this->assertInternalType('array', $build->children($routes));
    }

    /**
     *
     */
    function test_create_route_definition()
    {
        $build = new Build;

        $route = new Config([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ]);

        $this->assertInstanceOf(Config::class, $build->create($route));
    }

    /**
     *
     */
    function test_create_with_class_name()
    {
        $build = new Build;

        $route = [
            Arg::CHILDREN    => [],
            Arg::CLASS_NAME  => Config::class,
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $build->create($route));
    }

    /**
     *
     */
    function test_create()
    {
        $build = new Build;

        $route = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $build->create($route));
    }

    /**
     *
     */
    function test_create_default()
    {
        $build = new Build;

        $route = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $build->createDefault($route));
    }

    /**
     *
     */
    function test_build()
    {
        $build = new Build;

        $route = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::MAP         => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Route::class, $build->build($route));
    }
}
