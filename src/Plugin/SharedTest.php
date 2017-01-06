<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Args;
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

        $this->assertEquals('bar', $app->plugin(new Shared('foo', function() { return 'bar'; })));
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
        $this->assertEquals($value, $app->plugin(new Shared('foo', new Args($value))));
        $this->assertTrue($app->has('foo'));
        $this->assertEquals(['foo' => $value], $app->container());
        $this->assertEquals($value, $app->plugin(new Shared('foo')));
    }

    /**
     *
     */
    function test_null()
    {
        $app = new App;

        $this->assertEquals(null, $app->plugin(new Shared('foo', new Args(null))));
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
    function test_with_config()
    {
        $app = new App;

        $this->assertEquals('bar', $app->plugin(new Shared('foo', new Args('bar'))));
        $this->assertEquals('bar', $app->get('foo'));
    }
}
