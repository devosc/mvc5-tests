<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Maybe;
use Mvc5\Plugin\Nothing;
use Mvc5\Plugin\Nullable;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class MaybeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $maybe = new Maybe('foo');

        $this->assertEquals('foo', $maybe->config());
        $this->assertEquals([], $maybe->args());
        $this->assertEquals([[Maybe::class, 'nothing']], $maybe->filter());
        $this->assertNull($maybe->param());
    }

    /**
     *
     */
    function test_nothing()
    {
        $this->assertEquals('foo', Maybe::nothing('foo'));
        $this->assertInstanceOf(Nothing::class, Maybe::nothing(null));
    }

    /**
     *
     */
    function test_plugin_returns_false()
    {
        $app = new App(['services' => [
            'foo' => new Maybe(false)
        ]]);

        $this->assertFalse($app['foo']);
        $this->assertFalse($app->plugin('foo'));
    }

    /**
     *
     */
    function test_plugin_returns_nothing()
    {
        $app = new App(['services' => [
            'foo' => new Nothing,
            'foobar' => new Nullable(new Plugin('foo'))
        ]]);

        $this->assertInstanceOf(Nothing::class, $app->plugin('foo'));
        $this->assertInstanceOf(Nothing::class, $app->shared('foo'));
        $this->assertNull($app['foobar']);
        $this->assertNull($app->get('foobar'));
    }

    /**
     *
     */
    function test_plugin_returns_null()
    {
        $app = new App(['services' => [
            'foo' => new Maybe(null),
            'foobar' => new Nullable(new Plugin('foo'))
        ]]);

        $this->assertNull($app['foobar']);
        $this->assertInstanceOf(Nothing::class, $app['foo']);
        $this->assertInstanceOf(Nothing::class, $app->plugin('foo'));
    }

    /**
     *
     */
    function test_plugin_returns_something()
    {
        $app = new App(['services' => [
            'foo' => new Maybe('foobar')
        ]]);

        $this->assertEquals('foobar', $app['foo']);
        $this->assertEquals('foobar', $app->plugin('foo'));
    }
}
