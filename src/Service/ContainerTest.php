<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_clone_with_arrays()
    {
        $container = new Container;

        $clone = clone $container;

        $this->assertEquals($clone, $container);

        $clone->set('a', 'a');

        $this->assertNotSame($clone, $container);
        $this->assertEquals([], $container->container());
        $this->assertEquals(['a' => 'a'], $clone->container());
    }

    /**
     *
     */
    function test_clone_container_array()
    {
        $a = new \stdClass;
        $a->b = 'b';

        $container = new Container(['services' => ['a' => $a]]);

        $clone = clone $container;

        $this->assertEquals(['a' => $a], $clone->services());
    }

    /**
     *
     */
    function test_clone_with_objects()
    {
        $container = new Container(new Config([
            'container' => new Config,
            'services' => new Config
        ]));

        $clone = clone $container;

        $this->assertEquals($clone, $container);

        $this->assertNotSame($clone->config(), $container->config());
        $this->assertNotSame($clone->container(), $container->container());
        $this->assertNotSame($clone->services(), $container->services());
    }

    /**
     *
     */
    function test_config()
    {
        $container = new Container(['services' => ['foo' => 'bar']]);

        $this->assertEquals(['services' => ['foo' => 'bar']], $container->config());
    }

    /**
     *
     */
    function test_configured_not_null()
    {
        $container = new Container(['services' => ['foo' => 'bar']]);

        $this->assertEquals('bar', $container->configured('foo'));
    }

    /**
     *
     */
    function test_configured_null()
    {
        $container = new Container;

        $this->assertNull($container->configured('foo'));
    }

    /**
     *
     */
    function test_count()
    {
        $container = new Container(['container' => [1, 2, 3, 4, 5]]);

        $this->assertEquals(5, count($container));
    }

    /**
     *
     */
    function test_current_array()
    {
        $container = new Container(['container' => ['foo' => 'bar']]);

        $this->assertEquals('bar', $container->current());
    }

    /**
     *
     */
    function test_current_iterator()
    {
        $container = new Container(['container' => new Config(['foo' => 'bar'])]);

        $this->assertEquals('bar', $container->current());
    }

    /**
     *
     */
    function test_get()
    {
        $container = new Container(['container' => ['foo' => 'bar']]);

        $this->assertEquals('bar', $container->get('foo'));
    }

    /**
     *
     */
    function test_get_returns_null()
    {
        $container = new Container;

        $this->assertNull($container->get('foo'));
    }

    /**
     *
     */
    function test_has()
    {
        $container = new Container;

        $this->assertFalse($container->has('foo'));
    }

    /**
     *
     */
    function test_has_stored()
    {
        $container = new Container(['container' => ['foo' => 'bar']]);

        $this->assertTrue($container->has('foo'));
    }

    /**
     *
     */
    function test_key_array()
    {
        $container = new Container(['container' => ['foo' => 'bar']]);

        $this->assertEquals('foo', $container->key());
    }

    /**
     *
     */
    function test_key_iterator()
    {
        $container = new Container(['container' => new Config(['foo' => 'bar'])]);

        $this->assertEquals('foo', $container->key());
    }

    /**
     *
     */
    function test_next_array()
    {
        $container = new Container(['container' => ['foo' => 'bar', 'baz' => 'bat']]);

        $container->next();

        $this->assertEquals('bat', $container->current());
    }

    /**
     *
     */
    function test_next_iterator()
    {
        $container = new Container(['container' => new Config(['foo' => 'bar', 'baz' => 'bat'])]);

        $container->next();

        $this->assertEquals('bat', $container->current());
    }

    /**
     *
     */
    function test_remove()
    {
        $container = new Container(['container' => ['foo' => 'bar']]);

        $this->assertTrue($container->has('foo'));

        $container->remove('foo');

        $this->assertFalse($container->has('foo'));
    }

    /**
     *
     */
    function test_remove_array()
    {
        $container = new Container(['container' => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertTrue($container->has('foo'));
        $this->assertTrue($container->has('baz'));

        $container->remove(['foo', 'baz']);

        $this->assertFalse($container->has('foo'));
        $this->assertFalse($container->has('baz'));
    }

    /**
     *
     */
    function test_rewind_array()
    {
        $container = new Container(['container' => ['foo' => 'bar', 'baz' => 'bat']]);

        $this->assertEquals('bar', $container->current());

        $container->next();

        $this->assertEquals('bat', $container->current());

        $container->rewind();

        $this->assertEquals('bar', $container->current());
    }

    /**
     *
     */
    function test_rewind_iterator()
    {
        $container = new Container(['container' => new Config(['foo' => 'bar', 'baz' => 'bat'])]);

        $this->assertEquals('bar', $container->current());

        $container->next();

        $this->assertEquals('bat', $container->current());

        $container->rewind();

        $this->assertEquals('bar', $container->current());
    }

    /**
     *
     */
    function test_services()
    {
        $container = new Container(['services' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $container->services());
    }

    /**
     *
     */
    function test_set()
    {
        $container = new Container;

        $container->set('foo', 'bar');

        $this->assertEquals('bar', $container->get('foo'));
    }

    /**
     *
     */
    function test_set_array()
    {
        $container = new Container;

        $container->set(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $container->get('foo'));
        $this->assertEquals('bat', $container->get('baz'));
    }

    /**
     *
     */
    function test_valid_array()
    {
        $container = new Container(['container' => ['foo' => 'bar']]);

        $this->assertTrue($container->valid());
    }

    /**
     *
     */
    function test_valid_not_array()
    {
        $container = new Container;

        $this->assertFalse($container->valid());
    }

    /**
     *
     */
    function test_valid_with_iterator()
    {
        $container = new Container(['container' => new Config(['foo' => 'bar'])]);

        $this->assertTrue($container->valid());
    }

    /**
     *
     */
    function test_valid_not_with_iterator()
    {
        $container = new Container(['container' => new Config]);

        $this->assertFalse($container->valid());
    }
}
