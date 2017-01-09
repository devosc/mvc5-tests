<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Config as _Config;
use Mvc5\Route\Route;
use Mvc5\Route\Config;
use Mvc5\Test\Test\TestCase;

class BuildTest
    extends TestCase
{
    /**
     * @param array $route
     * @return array
     */
    protected function route(array $route = [])
    {
        return $route + [
            Arg::CHILDREN    => ['foo' => [Arg::ROUTE => 'foo']],
            Arg::CONSTRAINTS => null,
            Arg::NAME        => null,
            Arg::OPTIONS     => null,
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];
    }

    /**
     *
     */
    function test_custom_route()
    {
        $build = new Build;

        $route = $build->build($this->route(['class' => Config::class]), true, true);

        $foo = new Config(['route' => 'foo', 'tokens' => [['literal', 'foo']], 'regex' => 'foo']);

        $this->assertInstanceOf(Config::class, $route);
        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([['literal', '/']], $route->tokens());
        $this->assertEquals(['foo' => $foo], $route->children());
    }

    /**
     *
     */
    function test_no_route_or_regex_exception()
    {
        $build = new Build;

        $this->setExpectedException('Exception', 'Route path not specified');

        $build->build([]);
    }

    /**
     *
     */
    function test_regex_only()
    {
        $build = new Build;

        $route = $build->build([Arg::REGEX => '/']);

        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([], $route->tokens());
        $this->assertEquals([], $route->children());
    }

    /**
     *
     */
    function test_route()
    {
        $build = new Build;

        $route = $build->build($this->route(), true, true);

        $foo = new Config(['route' => 'foo', 'tokens' => [['literal', 'foo']], 'regex' => 'foo']);

        $this->assertInstanceOf(Route::class, $route);
        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([['literal', '/']], $route->tokens());
        $this->assertEquals(['foo' => $foo], $route->children());
    }

    /**
     *
     */
    function test_route_object()
    {
        $build = new Build;
        $route = new Config($this->route());

        $route = $build->build($route, true, true);

        $foo = new Config(['route' => 'foo', 'tokens' => [['literal', 'foo']], 'regex' => 'foo']);

        $this->assertInstanceOf(Route::class, $route);
        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([['literal', '/']], $route->tokens());
        $this->assertEquals(['foo' => $foo], $route->children());
    }
}
