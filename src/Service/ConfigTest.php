<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Container;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_config_empty()
    {
        $config = new Config;

        $this->assertEquals([], $config->config());
    }

    /**
     *
     */
    public function test_config()
    {
        $config = new Config;

        $this->assertEquals(['foo'], $config->config(['foo']));
    }

    /**
     *
     */
    public function test_configure()
    {
        $config = new Config;

        $config->configure('foo', 'bar');

        $this->assertEquals('bar', $config->configured('foo'));
    }

    /**
     *
     */
    public function test_configured_null()
    {
        $config = new Config;

        $this->assertEquals(null, $config->configured('foo'));
    }

    /**
     *
     */
    public function test_configured_not_null()
    {
        $config = new Config;

        $config->configure('foo', 'bar');

        $this->assertEquals('bar', $config->configured('foo'));
    }

    /**
     *
     */
    public function test_container_empty()
    {
        $config = new Config;

        $this->assertEquals([], $config->container());
    }

    /**
     *
     */
    public function test_container_not_empty()
    {
        $config = new Config;

        $this->assertEquals(['foo'], $config->container(['foo']));
    }

    /**
     *
     */
    public function test_count()
    {
        $config = new Config;

        $config->container([1, 2, 3, 4, 5]);

        $this->assertEquals(5, count($config));
    }

    /**
     *
     */
    public function test_current_array()
    {
        $config = new Config;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    public function test_current_iterator()
    {
        $config = new Config;

        $config->container(new Container(['foo' => 'bar']));

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    public function test_get()
    {
        $config = new Config;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        $config = new Config;

        $this->assertEquals(false, $config->has('foo'));
    }

    /**
     *
     */
    public function test_key_array()
    {
        $config = new Config;

        $config->container(['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    public function test_key_iterator()
    {
        $config = new Config;

        $config->container(new Container(['foo' => 'bar']));

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    public function test_next_array()
    {
        $config = new Config;

        $config->container(['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    public function test_next_iterator()
    {
        $config = new Config();

        $config->container(new Container(['foo' => 'bar', 'baz' => 'bat']));

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    public function test_remove()
    {
        $config = new Config;

        $config->container(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));

        $config->remove('foo');

        $this->assertEquals(false, $config->has('foo'));
    }

    /**
     *
     */
    public function test_rewind_array()
    {
        $config = new Config;

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
    public function test_rewind_iterator()
    {
        $config = new Config;

        $config->container(new Container(['foo' => 'bar', 'baz' => 'bat']));

        $this->assertEquals('bar', $config->current());

        $config->next();

        $this->assertEquals('bat', $config->current());

        $config->rewind();

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    public function test_shared_null()
    {
        $config = new Config;

        $this->assertEquals(null, $config->shared('foo'));
    }

    /**
     *
     */
    public function test_shared_not_null()
    {
        $config = new Config;

        $config->set('foo', 'bar');

        $this->assertEquals('bar', $config->shared('foo'));
    }

    /**
     *
     */
    public function test_services_empty()
    {
        $config = new Config;

        $this->assertEquals([], $config->services());
    }

    /**
     *
     */
    public function test_services_not_empty()
    {
        $config = new Config;

        $this->assertEquals(['foo'], $config->services(['foo']));
    }

    /**
     *
     */
    public function test_set()
    {
        $config = new Config;

        $config->set('foo', 'bar');

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    public function test_valid_array()
    {
        $config = new Config;

        $config->container(['foo' => 'bar']);

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    public function test_valid_not_array()
    {
        $config = new Config;

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    public function test_valid_with_iterator()
    {
        $config = new Config;

        $config->container(new Container(['foo' => 'bar']));

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    public function test_valid_not_with_iterator()
    {
        $config = new Config;

        $config->container(new Container);

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    public function test_clone_with_arrays()
    {
        $config = new Config;

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
    public function test_clone_with_objects()
    {
        $config = new Config(new Container);

        $config->container(new Container);
        $config->services(new Container);

        $clone = clone $config;

        $this->assertEquals(true, $clone == $config);

        $clone->config(new Container(['foo' => 'bar']));
        $clone->set('a', 'a');
        $clone->configure('baz', 'bat');

        $this->assertEquals(false,                           $clone == $config);
        $this->assertEquals(new Container,                   $config->config());
        $this->assertEquals(new Container,                   $config->services());
        $this->assertEquals(new Container,                   $config->container());
        $this->assertEquals(new Container(['foo' => 'bar']), $clone->config());
        $this->assertEquals(new Container(['a'   => 'a']),   $clone->container());
        $this->assertEquals(new Container(['baz' => 'bat']), $clone->services());
    }
}
