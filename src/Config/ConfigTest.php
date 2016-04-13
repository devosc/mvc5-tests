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
    public function test_current_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->current());
    }

    /**
     *
     */
    public function test_current_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar']));

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
    public function test_key_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    public function test_key_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertEquals('foo', $config->key());
    }

    /**
     *
     */
    public function test_next_array()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $config->next();

        $this->assertEquals('bat', $config->current());
    }

    /**
     *
     */
    public function test_next_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar', 'baz' => 'bat']));

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
    public function test_rewind_array()
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
    public function test_rewind_iterator()
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
    public function test_set()
    {
        $config = new Config;

        $this->assertEquals('bar', $config->set('foo', 'bar'));
    }

    /**
     *
     */
    public function test_valid_array()
    {
        $config = new Config(['foo' => 'bar']);

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
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    public function test_valid_not_with_iterator()
    {
        $config = new Config(new Config);

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    public function test_clone_array_config()
    {
        $config = new Config(['a' => 'a']);

        $clone = clone $config;

        $this->assertEquals(true, $clone == $config);

        $clone['a'] = 'a1';
        $clone['b'] = 'b';

        $this->assertEquals(false, $clone == $config);
        $this->assertEquals('a',   $config['a']);
        $this->assertEquals('a1',  $clone['a']);
        $this->assertEquals(false, isset($config['b']));
        $this->assertEquals(true,  isset($clone['b']));
        $this->assertEquals(false, $clone === $config);
    }

    /**
     *
     */
    public function test_clone_object_config()
    {
        $config = new Config(new Config(['a' => 'a']));

        $clone = clone $config;

        $this->assertEquals(true, $clone == $config);

        $clone['a'] = 'a1';
        $clone['b'] = 'b';

        $this->assertEquals(false, $clone == $config);
        $this->assertEquals('a',   $config['a']);
        $this->assertEquals('a1',  $clone['a']);
        $this->assertEquals(false, isset($config['b']));
        $this->assertEquals(true,  isset($clone['b']));
    }
}
