<?php
/**
 *
 */

namespace Mvc5\Test\Service\Config;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_config_empty()
    {
        $config = new Container;

        $this->assertEquals([], $config->config());
    }

    /**
     *
     */
    function test_config()
    {
        $config = new Container;

        $this->assertEquals(['foo'], $config->config(['foo']));
    }

    /**
     *
     */
    function test_configure()
    {
        $config = new Container;

        $this->assertEquals('bar', $config->configure('foo', 'bar'));
    }

    /**
     *
     */
    function test_configured_null()
    {
        $config = new Container;

        $this->assertEquals(null, $config->configured('foo'));
    }

    /**
     *
     */
    function test_configured_not_null()
    {
        $config = new Container;

        $config->configure('foo', 'bar');

        $this->assertEquals('bar', $config->configured('foo'));
    }

    /**
     *
     */
    function test_container_empty()
    {
        $config = new Container;

        $this->assertEquals([], $config->container());
    }

    /**
     *
     */
    function test_container_not_empty()
    {
        $config = new Container;

        $this->assertEquals(['foo'], $config->container(['foo']));
    }

    /**
     *
     */
    function test_count()
    {
        $config = new Container;

        $config->container([1, 2, 3, 4, 5]);

        $this->assertEquals(5, count($config));
    }

    /**
     *
     */
    function test_current_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_current_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar']));

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_get()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_has()
    {
        $config = new Container;

        $this->assertEquals(false, $config->has('foo'));
    }

    /**
     *
     */
    function test_has_stored()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));
    }

    /**
     *
     */
    function test_key_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function test_key_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar']));

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function test_next_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function test_next_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar', 'baz' => 'bat']));

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function test_remove()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));

        $config->remove('foo');

        $this->assertEquals(false, $config->has('foo'));
    }

    /**
     *
     */
    function test_rewind_array()
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
    function test_rewind_iterator()
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
    function test_stored_null()
    {
        $config = new Container;

        $this->assertEquals(null, $config->stored('foo'));
    }

    /**
     *
     */
    function test_stored_not_null()
    {
        $config = new Container;

        $config->set('foo', 'bar');

        $this->assertEquals('bar', $config->stored('foo'));
    }

    /**
     *
     */
    function test_services_empty()
    {
        $config = new Container;

        $this->assertEquals([], $config->services());
    }

    /**
     *
     */
    function test_services_not_empty()
    {
        $config = new Container;

        $this->assertEquals(['foo'], $config->services(['foo']));
    }

    /**
     *
     */
    function test_set()
    {
        $config = new Container;

        $config->set('foo', 'bar');

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_valid_array()
    {
        $config = new Container;

        $config->container(['foo' => 'bar']);

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    function test_valid_not_array()
    {
        $config = new Container;

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    function test_valid_with_iterator()
    {
        $config = new Container;

        $config->container(new Config(['foo' => 'bar']));

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    function test_valid_not_with_iterator()
    {
        $config = new Container;

        $config->container(new Config);

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    function test_clone_with_arrays()
    {
        $config = new Container;

        $clone = clone $config;

        $this->assertEquals(true, $clone == $config);

        $clone->config(['foo' => 'bar']);
        $clone->set('a', 'a');
        $clone->configure('baz', 'bat');

        $this->assertEquals(false,            $clone == $config);
        $this->assertEquals([],               $config->config());
        $this->assertEquals([],               $config->container());
        $this->assertEquals([],               $config->services());
        $this->assertEquals(['foo' => 'bar'], $clone->config());
        $this->assertEquals(['a'   => 'a'],   $clone->container());
        $this->assertEquals(['baz' => 'bat'], $clone->services());
    }

    /**
     *
     */
    function test_clone_container_array()
    {
        $resolver = new Container;

        $a = new \stdClass;
        $a->b = 'b';

        $resolver->container(['a' => $a]);

        $clone = clone $resolver;

        $this->assertEquals(true, $clone == $resolver);
        $this->assertInstanceOf(\stdClass::class, $clone->get('a'));
        $this->assertEquals($a, $clone->get('a'));
        $this->assertTrue($a === $clone->get('a'));
    }

    /**
     *
     */
    function test_clone_with_objects()
    {
        $config = new Container(new Config);

        $config->container(new Config);
        $config->services(new Config);

        $clone = clone $config;

        $this->assertEquals(true, $clone == $config);

        $clone->config(new Config(['foo' => 'bar']));
        $clone->set('a', 'a');
        $clone->configure('baz', 'bat');

        $this->assertEquals(false,                        $clone == $config);
        $this->assertEquals(new Config,                   $config->config());
        $this->assertEquals(new Config,                   $config->services());
        $this->assertEquals(new Config,                   $config->container());
        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
        $this->assertEquals(new Config(['a'   => 'a']),   $clone->container());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());
    }
}
