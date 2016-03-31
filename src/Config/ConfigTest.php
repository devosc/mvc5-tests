<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_count()
    {
        $config = new Config([1, 2, 3, 4, 5]);

        $this->assertEquals(5, count($config));
    }

    /**
     *
     */
    public function test_current()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    public function test_get_isset()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    public function test_get_not_isset()
    {
        $config = new Config;

        $this->assertEquals(null, $config->get('foo'));
    }

    /**
     *
     */
    public function test_has()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));
    }

    /**
     *
     */
    public function test_has_not()
    {
        $config = new Config;

        $this->assertEquals(false, $config->has('foo'));
    }

    /**
     *
     */
    public function test_key()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    public function test_next()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    public function test_remove()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));

        $config->remove('foo');

        $this->assertEquals(false, $config->has('foo'));
    }

    /**
     *
     */
    public function test_rewind()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $config->current());

        $config->next();

        $this->assertEquals('bat', $config->current());

        $config->rewind();

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    public function test_set()
    {
        $config = new Config;

        $this->assertEquals('bar', $config->set('foo', 'bar'));
    }

    /**
     *
     */
    public function test_valid()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    public function test_valid_not()
    {
        $config = new Config;

        $this->assertEquals(false, $config->valid());
    }
}
