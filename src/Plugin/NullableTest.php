<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Maybe;
use Mvc5\Plugin\Nullable;
use Mvc5\Plugin\Shared;
use Mvc5\Test\Test\TestCase;

class NullableTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $maybe = new Nullable('foo');

        $this->assertEquals([$maybe, '__invoke'], $maybe->config());
        $this->assertEquals(['foo'], $maybe->args());
        $this->assertNull((new Nullable)());
    }

    /**
     *
     */
    function test_custom_default()
    {
        $this->assertEquals('bar', (new App)(new Nullable(new Maybe, 'bar')));
   }

    /**
     *
     */
    function test_default()
    {
        $this->assertEquals(null, (new App)(new Nullable));
    }

    /**
     *
     */
    function test_null_value()
    {
        $count = 0;

        $app = new App(['services' => [
            'foo' => new Maybe(new Call(function() use (&$count) {
                ++$count;
                return null;
            })),
            'foobar' => new Nullable(new Shared('foo'))
        ]]);

        $this->assertNull($app->plugin('foobar'));
        $this->assertNull($app->shared('foobar'));
        $this->assertNull($app->get('foobar'));
        $this->assertNull($app['foobar']);
        $this->assertEquals(1, $count);
    }

    /**
     *
     */
    function test_value_not_null()
    {
        $count = 0;

        $app = new App(['services' => [
            'foo' => new Maybe(new Call(function() use (&$count) {
                ++$count;
                return 'bar';
            })),
            'foobar' => new Nullable(new Shared('foo'))
        ]]);

        $this->assertEquals('bar', $app->plugin('foobar'));
        $this->assertEquals('bar', $app->shared('foobar'));
        $this->assertEquals('bar', $app->get('foobar'));
        $this->assertEquals('bar', $app['foobar']);
        $this->assertEquals(1, $count);
    }
}
