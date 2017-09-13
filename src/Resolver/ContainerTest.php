<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Maybe;
use Mvc5\Plugin\Nothing;
use Mvc5\Plugin\Shared;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_clone_with_arrays()
    {
        $app = new App;

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $clone->set('a', 'a');

        $this->assertNotSame($clone, $app);
        $this->assertEquals([], $app->container());
        $this->assertEquals(['a' => 'a'], $clone->container());
    }

    /**
     *
     */
    function test_clone_container_array()
    {
        $a = new \stdClass;
        $a->b = 'b';

        $app = new App(['services' => ['a' => $a]]);

        $clone = clone $app;

        $this->assertEquals(['a' => $a], $clone->services());
    }

    /**
     *
     */
    function test_clone_with_objects()
    {
        $app = new App(new Config([
            'container' => new Config,
            'services' => new Config
        ]));

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $this->assertNotSame($clone->config(), $app->config());
        $this->assertNotSame($clone->container(), $app->container());
        $this->assertNotSame($clone->services(), $app->services());
    }

    /**
     *
     */
    function test_config()
    {
        $app = new App(['services' => ['foo' => 'bar']]);

        $this->assertEquals(['services' => ['foo' => 'bar']], $app->config());
    }

    /**
     *
     */
    function test_count()
    {
        $app = new App(['container' => [1, 2, 3, 4, 5]]);

        $this->assertEquals(5, count($app));
    }

    /**
     *
     */
    function test_current_array()
    {
        $app = new App(['container' => ['foo' => 'bar']]);

        $this->assertEquals('bar', $app->current());
    }

    /**
     *
     */
    function test_current_iterator()
    {
        $app = new App(['container' => new Config(['foo' => 'bar'])]);

        $this->assertEquals('bar', $app->current());
    }

    /**
     *
     */
    function test_get()
    {
        $app = new App(['container' => ['foo' => 'bar']]);

        $this->assertEquals('bar', $app->get('foo'));
    }

    /**
     *
     */
    function test_get_returns_null()
    {
        $app = new App;

        $this->assertNull($app->get('foo'));
    }

    /**
     *
     */
    function test_has()
    {
        $app = new App;

        $this->assertFalse($app->has('foo'));
    }

    /**
     *
     */
    function test_has_stored()
    {
        $app = new App(['container' => ['foo' => 'bar']]);

        $this->assertTrue($app->has('foo'));
    }

    /**
     *
     */
    function test_key_array()
    {
        $app = new App(['container' => ['foo' => 'bar']]);

        $this->assertEquals('foo', $app->key());
    }

    /**
     *
     */
    function test_key_iterator()
    {
        $app = new App(['container' => new Config(['foo' => 'bar'])]);

        $this->assertEquals('foo', $app->key());
    }

    /**
     *
     */
    function test_next_array()
    {
        $app = new App(['container' => ['foo' => 'bar', 'baz' => 'bat']]);

        $app->next();

        $this->assertEquals('bat', $app->current());
    }

    /**
     *
     */
    function test_next_iterator()
    {
        $app = new App(['container' => new Config(['foo' => 'bar', 'baz' => 'bat'])]);

        $app->next();

        $this->assertEquals('bat', $app->current());
    }

    /**
     *
     */
    function test_nothing_isset()
    {
        $app = new App;

        $app['foo'] = new Nothing;

        $this->assertTrue(isset($app['foo']));
        $this->assertNull($app['foo']);
    }

    /**
     *
     */
    function test_null_not_isset()
    {
        $app = new App;

        $app['foo'] = null;

        $this->assertFalse(isset($app['foo']));
        $this->assertNull($app['foo']);
    }

    /**
     *
     */
    function test_shared_method_returns_nothing()
    {
        $count = 0;

        $app = new App;

        $this->assertNull($app->shared('foo', function() use(&$count) {
            ++$count;
            return new Nothing;
        }));

        $this->assertNull($app->get('foo'));
        $this->assertNull($app->shared('foo'));
        $this->assertEquals(1, $count);
    }

    /**
     *
     */
    function test_shared_method_returns_null()
    {
        $app = new App;

        $this->assertNull($app->shared('foo', function() {
            return null;
        }));

        $this->assertFalse($app->has('foo'));
    }

    /**
     *
     */
    function test_shared_maybe_plugin_returns_nothing()
    {
        $count = 0;

        $app = new App(['services' => [
            'foo' => new Shared('foo', new Maybe(function() use (&$count) {
                ++$count;
                return new Nothing;
            }))
        ]]);

        $this->assertNull($app->plugin('foo'));
        $this->assertNull($app->shared('foo'));
        $this->assertNull($app->get('foo'));
        $this->assertNull($app['foo']);
        $this->assertEquals(1, $count);
    }

    /**
     *
     */
    function test_shared_maybe_plugin_returns_null()
    {
        $count = 0;

        $app = new App(['services' => [
            'foo' => new Shared('foo', new Maybe(function() use (&$count) {
                ++$count;
                return null;
            }))
        ]]);

        $this->assertNull($app->plugin('foo'));
        $this->assertNull($app->shared('foo'));
        $this->assertNull($app->get('foo'));
        $this->assertNull($app['foo']);
        $this->assertEquals(1, $count);
    }

    /**
     *
     */
    function test_shared_plugin_returns_nothing()
    {
        $count = 0;

        $app = new App(['services' => [
            'foo' => new Shared('foo', function() use(&$count) {
                ++$count;
                return new Nothing;
            })
        ]]);

        $this->assertNull($app->plugin('foo'));
        $this->assertNull($app->shared('foo'));
        $this->assertNull($app->get('foo'));
        $this->assertEquals(1, $count);
    }

    /**
     *
     */
    function test_shared_plugin_returns_null()
    {
        $count = 0;

        $app = new App(['services' => [
            'foo' => new Shared('foo', function() use(&$count) {
                ++$count;
                return null;
            })
        ]]);

        $this->assertNull($app->plugin('foo'));
        $this->assertNull($app->shared('foo'));
        $this->assertNull($app->get('foo'));
        $this->assertEquals(3, $count);
    }

    /**
     *
     */
    function test_remove()
    {
        $app = new App(['container' => ['foo' => 'bar']]);

        $this->assertTrue($app->has('foo'));

        $app->remove('foo');

        $this->assertFalse($app->has('foo'));
    }

    /**
     *
     */
    function test_remove_array()
    {
        $app = new App(['container' => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertTrue($app->has('foo'));
        $this->assertTrue($app->has('baz'));

        $app->remove(['foo', 'baz']);

        $this->assertFalse($app->has('foo'));
        $this->assertFalse($app->has('baz'));
    }

    /**
     *
     */
    function test_rewind_array()
    {
        $app = new App(['container' => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertEquals('bar', $app->current());

        $app->next();

        $this->assertEquals('bat', $app->current());

        $app->rewind();

        $this->assertEquals('bar', $app->current());
    }

    /**
     *
     */
    function test_rewind_iterator()
    {
        $app = new App(['container' => new Config(['foo' => 'bar', 'baz' => 'bat'])]);

        $this->assertEquals('bar', $app->current());

        $app->next();

        $this->assertEquals('bat', $app->current());

        $app->rewind();

        $this->assertEquals('bar', $app->current());
    }

    /**
     *
     */
    function test_services()
    {
        $app = new App(['services' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $app->services());
    }

    /**
     *
     */
    function test_set()
    {
        $app = new App;

        $app->set('foo', 'bar');

        $this->assertEquals('bar', $app->get('foo'));
    }

    /**
     *
     */
    function test_set_array()
    {
        $app = new App;

        $app->set(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $app->get('foo'));
        $this->assertEquals('bat', $app->get('baz'));
    }

    /**
     *
     */
    function test_valid_array()
    {
        $app = new App(['container' => ['foo' => 'bar']]);

        $this->assertTrue($app->valid());
    }

    /**
     *
     */
    function test_valid_not_array()
    {
        $app = new App;

        $this->assertFalse($app->valid());
    }

    /**
     *
     */
    function test_valid_with_iterator()
    {
        $app = new App(['container' => new Config(['foo' => 'bar'])]);

        $this->assertTrue($app->valid());
    }

    /**
     *
     */
    function test_valid_not_with_iterator()
    {
        $app = new App(['container' => new Config]);

        $this->assertFalse($app->valid());
    }
}
