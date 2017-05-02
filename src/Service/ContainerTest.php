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
        $config = new Container;

        $clone = clone $config;

        $this->assertEquals($clone, $config);

        $clone->set('a', 'a');

        $this->assertNotSame($clone, $config);
        $this->assertEquals([], $config->container());
        $this->assertEquals(['a' => 'a'], $clone->container());
    }

    /**
     *
     */
    function atest_clone_container_array()
    {
        $resolver = new Container;

        $a = new \stdClass;
        $a->b = 'b';

        $resolver->container(['a' => $a]);

        $clone = clone $resolver;

        $this->assertEquals($clone, $resolver);
        $this->assertInstanceOf(\stdClass::class, $clone->get('a'));
        $this->assertEquals($a, $clone->get('a'));
        $this->assertTrue($a === $clone->get('a'));
    }

    /**
     *
     */
    function atest_clone_with_objects()
    {
        $config = new Container(new Config);

        $config->container(new Config);
        $config->services(new Config);

        $clone = clone $config;

        $this->assertEquals($clone, $config);

        $clone->config(new Config(['foo' => 'bar']));
        $clone->set('a', 'a');
        $clone->configure('baz', 'bat');

        $this->assertNotSame($clone, $config);
        $this->assertEquals(new Config, $config->config());
        $this->assertEquals(new Config, $config->services());
        $this->assertEquals(new Config, $config->container());
        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
        $this->assertEquals(new Config(['a' => 'a']), $clone->container());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());
    }

    /**
     *
     */
    function atest_config()
    {
        $config = new Container;

        $this->assertEquals(['foo'], $config->config(['foo']));
    }

    /**
     *
     */
    function atest_config_empty()
    {
        $config = new Container;

        $this->assertEquals([], $config->config());
    }

    /**
     *
     */
    function atest_configure()
    {
        $config = new Container;

        $this->assertEquals('bar', $config->configure('foo', 'bar'));
    }

    /**
     *
     */
    function atest_configured_not_null()
    {
        $config = new Container;

        $config->configure('foo', 'bar');

        $this->assertEquals('bar', $config->configured('foo'));
    }

    /**
     *
     */
    function atest_configured_null()
    {
        $config = new Container;

        $this->assertEquals(null, $config->configured('foo'));
    }

    /**
     *
     */
    function atest_container_empty()
    {
        $config = new Container;

        $this->assertEquals([], $config->container());
    }

    /**
     *
     */
    function atest_container_not_empty()
    {
        $config = new Container;

        $this->assertEquals(['foo'], $config->container(['foo']));
    }

    /**
     *
     */
    function atest_count()
    {
        $config = new Container;

        $config->container([1, 2, 3, 4, 5]);

        $this->assertEquals(5, count($config));
    }

    /**
     *
     */
    function atest_current_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function atest_current_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar']));

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function atest_get()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function atest_get_returns_null()
    {
        $config = new Container;

        $this->assertNull($config->get('foo'));
    }

    /**
     *
     */
    function atest_has()
    {
        $config = new Container;

        $this->assertFalse($config->has('foo'));
    }

    /**
     *
     */
    function atest_has_stored()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertTrue($config->has('foo'));
    }

    /**
     *
     */
    function atest_key_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function atest_key_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar']));

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function atest_next_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function atest_next_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar', 'baz' => 'bat']));

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function atest_remove()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertTrue($config->has('foo'));

        $config->remove('foo');

        $this->assertFalse($config->has('foo'));
    }

    /**
     *
     */
    function atest_remove_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertTrue($config->has('foo'));
        $this->assertTrue($config->has('baz'));

        $config->remove(['foo', 'baz']);

        $this->assertFalse($config->has('foo'));
        $this->assertFalse($config->has('baz'));
    }

    /**
     *
     */
    function atest_rewind_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $config->current());

        $config->next();

        $this->assertEquals('bat', $config->current());

        $config->rewind();

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function atest_rewind_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar', 'baz' => 'bat']));

        $this->assertEquals('bar', $config->current());

        $config->next();

        $this->assertEquals('bat', $config->current());

        $config->rewind();

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function atest_services_empty()
    {
        $config = new Container;

        $this->assertEquals([], $config->services());
    }

    /**
     *
     */
    function atest_services_not_empty()
    {
        $config = new Container;

        $this->assertEquals(['foo'], $config->services(['foo']));
    }

    /**
     *
     */
    function atest_set()
    {
        $config = new Container;

        $config->set('foo', 'bar');

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function atest_set_array()
    {
        $config = new Container;

        $config->set(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $config->get('foo'));
        $this->assertEquals('bat', $config->get('baz'));
    }

    /**
     *
     */
    function atest_valid_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertTrue($config->valid());
    }

    /**
     *
     */
    function atest_valid_not_array()
    {
        $config = new Container;

        $this->assertFalse($config->valid());
    }

    /**
     *
     */
    function atest_valid_with_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar']));

        $this->assertTrue($config->valid());
    }

    /**
     *
     */
    function atest_valid_not_with_iterator()
    {
        $config = new Container;

        $config->container(new Config);

        $this->assertFalse($config->valid());
    }
}
