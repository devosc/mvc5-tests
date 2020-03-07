<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\NullValue;
use Mvc5\Plugin\Value;
use Mvc5\Plugin\Shared;
use Mvc5\Test\Test\TestCase;

class SharedTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $shared = new Shared('foo', 'bar');

        $this->assertEquals('foo', $shared->name());
        $this->assertEquals('bar', $shared->config());
    }

    /**
     *
     */
    function test_create()
    {
        $app = new App;

        $this->assertEquals('bar', $app->plugin(new Shared('foo', fn() => 'bar')));
        $this->assertEquals('bar', $app->get('foo'));
    }

    /**
     *
     */
    function test_not_null()
    {
        $app = new App;

        $value = 0;

        $this->assertFalse($app->has('foo'));
        $this->assertEquals($value, $app->plugin(new Shared('foo', new Value($value))));
        $this->assertTrue($app->has('foo'));
        $this->assertEquals($value, $app['foo']);
        $this->assertEquals($value, $app->plugin(new Shared('foo')));
    }

    /**
     *
     */
    function test_null_value()
    {
        $app = new App;

        $this->assertNull($app->plugin(new Shared('foo', new Value(null))));
        $this->assertFalse($app->has('foo'));
        $this->assertNull($app->get('foo'));
    }

    /**
     *
     */
    function test_null_value_plugin()
    {
        $app = new App;

        $this->assertNull($app->plugin(new Shared('foo', new NullValue)));
        $this->assertFalse($app->has('foo'));
        $this->assertNull($app->get('foo'));
    }

    /**
     *
     */
    function test_shared()
    {
        $app = new App;
        $app->set('foo', 'bar');

        $this->assertEquals('bar', $app->plugin(new Shared('foo')));
        $this->assertEquals('bar', $app->get('foo'));
    }

    /**
     *
     */
    function test_shared_plugin()
    {
        $app = new App;

        $this->assertEquals('bar', $app->plugin(new Shared('foo', new Value('bar'))));
        $this->assertEquals('bar', $app->get('foo'));
    }

    /**
     *
     */
    function test_shared_plugin_with_args()
    {
        $app = new App([
            'services' => [
                'foobar' => new Shared('foobar', [Config::class, ['foo' => 'bar']])
            ]
        ]);

        $this->assertEquals('baz', $app->plugin('foobar', [['foo' => 'baz']])['foo']);
        $this->assertEquals('baz', $app->plugin('foobar', [['foo' => 'bat']])['foo']);
    }
}
