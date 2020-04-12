<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

final class IteratorTest
    extends TestCase
{
    /**
     *
     */
    function test_count_array()
    {
        $config = new Config([1, 2, 3, 4, 5]);

        $this->assertEquals(5, count($config));
    }

    /**
     *
     */
    function test_count_iterator()
    {
        $config = new Config(new Config([1, 2, 3, 4, 5]));

        $this->assertEquals(5, count($config));
    }

    /**
     *
     */
    function test_current_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_current_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_count_object()
    {
        $config = new Config((object) ['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_key_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function test_key_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function test_key_object()
    {
        $config = new Config((object) ['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    function test_next_array()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function test_next_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar', 'baz' => 'bat']));

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function test_next_object()
    {
        $config = new Config((object) ['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    function test_rewind_array()
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
    function test_rewind_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar', 'baz' => 'bat']));

        $this->assertEquals('bar', $config->current());

        $config->next();

        $this->assertEquals('bat', $config->current());

        $config->rewind();

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_rewind_object()
    {
        $config = new Config((object) ['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $config->current());

        $config->next();

        $this->assertEquals('bat', $config->current());

        $config->rewind();

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    function test_valid_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue($config->valid());
    }

    /**
     *
     */
    function test_valid_not_array()
    {
        $config = new Config;

        $this->assertFalse($config->valid());
    }

    /**
     *
     */
    function test_valid_with_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertTrue($config->valid());
    }

    /**
     *
     */
    function test_valid_not_with_iterator()
    {
        $config = new Config(new Config);

        $this->assertFalse($config->valid());
    }

    /**
     *
     */
    function test_valid_with_object()
    {
        $config = new Config((object) ['foo' => 'bar']);

        $this->assertTrue($config->valid());
    }

    /**
     *
     */
    function test_valid_not_with_object()
    {
        $config = new Config(new \stdClass);

        $this->assertFalse($config->valid());
    }
}
