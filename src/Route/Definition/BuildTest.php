<?php
/**
 *
 */

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Config;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ CHILDREN, CONSTRAINTS, NAME, OPTIONS, PATH, REGEX, TOKENS };

final class BuildTest
    extends TestCase
{
    /**
     * @param array $route
     * @return array
     */
    protected function route(array $route = [])
    {
        return $route + [
            CHILDREN    => ['foo' => ['path' => 'foo']],
            CONSTRAINTS => null,
            NAME        => null,
            OPTIONS     => null,
            PATH        => '/',
            REGEX       => null,
            TOKENS      => null
        ];
    }

    /**
     * @throws \Throwable
     */
    function test_custom_route()
    {
        $build = new Build;

        $route = $build->build($this->route(['class' => Config::class]));

        $this->assertInstanceOf(Config::class, $route);
        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([['literal', '/']], $route->tokens());
        $this->assertEquals(['foo' => ['path' => 'foo']], $route->children());
    }

    /**
     * @throws \Throwable
     */
    function test_no_route_or_regex_exception()
    {
        $build = new Build;

        $this->expectExceptionMessage('Route path not specified');

        $build->build([]);
    }

    /**
     * @throws \Throwable
     */
    function test_regex_only()
    {
        $build = new Build;

        $route = $build->build([REGEX => '/']);

        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([], $route->tokens());
        $this->assertEquals([], $route->children());
    }

    /**
     * @throws \Throwable
     */
    function test_route()
    {
        $build = new Build;

        $route = $build->build($this->route());

        $this->assertInstanceOf(Route::class, $route);
        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([['literal', '/']], $route->tokens());
        $this->assertEquals(['foo' => ['path' => 'foo']], $route->children());
    }

    /**
     * @throws \Throwable
     */
    function test_route_object()
    {
        $build = new Build;

        $route = $build->build(new Config($this->route()));

        $this->assertInstanceOf(Route::class, $route);
        $this->assertNull($route->name());
        $this->assertEquals('/', $route->regex());
        $this->assertEquals([], $route->constraints());
        $this->assertEquals([], $route->options());
        $this->assertEquals([['literal', '/']], $route->tokens());
        $this->assertEquals(['foo' => ['path' => 'foo']], $route->children());
    }


    /**
     * @throws \Throwable
     */
    function test_host()
    {
        $build = new Build;

        $route = $build->build($this->route(['host' => [
            'name' => '{subdomain}.app.dev'
        ]]));

        $host = [
            'name' => '{subdomain}.app.dev',
            'tokens' =>
                [
                    ['param', 'subdomain', '[^/]+'],
                    ['literal', '.app.dev'],
                ],
            'regex' => '(?P<subdomain>[^/]+)\\.app\\.dev',
        ];

        $this->assertEquals($host, $route->host());
    }
}
