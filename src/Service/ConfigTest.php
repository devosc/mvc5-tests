<?php
/**
 *
 */

namespace Mvc5\Test\Service;

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
}
