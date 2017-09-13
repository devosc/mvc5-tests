<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Maybe;
use Mvc5\Plugin\Nothing;
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
            'foo' => new Maybe(new Nothing)
        ]]);

        $this->assertInstanceOf(Nothing::class, $app->plugin('foo'));
        $this->assertNull($app['foo']);
        $this->assertNull($app->get('foo'));
        $this->assertNull($app->shared('foo'));
    }

    /**
     *
     */
    function test_plugin_returns_null()
    {
        $app = new App(['services' => [
            'foo' => new Maybe(null)
        ]]);

        $this->assertNull($app['foo']);
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
