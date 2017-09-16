<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Maybe;
use Mvc5\Plugin\Nothing;
use Mvc5\Plugin\Nullable;
use Mvc5\Plugin\Plug;
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

        $this->assertEquals([$maybe, '__invoke'], $maybe->config());
        $this->assertEquals(['foo'], $maybe->args());
        $this->assertInstanceOf(Nothing::class, (new Maybe)());
    }

    /**
     *
     */
    function test_custom_default()
    {
        $this->assertEquals('bar', (new App)(new Maybe(null, 'bar')));
    }

    /**
     *
     */
    function test_default()
    {
        $this->assertInstanceOf(Nothing::class, (new Maybe)());
    }

    /**
     *
     */
    function test_null()
    {
        $app = new App(['services' => [
            'foo' => new Maybe(null),
            'foobar' => new Nullable(new Plugin('foo'))
        ]]);

        $this->assertInstanceOf(Nothing::class, $app['foo']);
        $this->assertNull($app['foobar']);
    }

    /**
     *
     */
    function test_not_null()
    {
        $app = new App(['services' => [
            'foo' => new Maybe('foobar'),
            'foobar' => new Nullable(new Plug('foo'))
        ]]);

        $this->assertEquals('foobar', $app['foo']);
        $this->assertEquals('foobar', $app['foobar']);
    }
}
