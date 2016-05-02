<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    function test_count()
    {
        $config = new Config([1, 2, 3, 4, 5]);

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
    function test_get_isset_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_get_not_isset_array()
    {
        $config = new Config;

        $this->assertEquals(null, $config->get('foo'));
    }

    /**
     *
     */
    function test_get_isset_object()
    {
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_get_not_isset_object()
    {
        $config = new Config(new Config);

        $this->assertEquals(null, $config->get('foo'));
    }

    /**
     *
     */
    function test_get_isset_app_container()
    {
        $config = new Config(new App([Arg::CONTAINER => ['foo' => 'bar']]));

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_get_isset_app_services()
    {
        $config = new Config(new App([Arg::SERVICES => ['foo' => new Value('bar')]]));

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_get_not_isset_app()
    {
        $config = new Config(new App);

        $this->assertEquals(null, $config->get('foo'));
    }

    /**
     *
     */
    function test_has()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));
    }

    /**
     *
     */
    function test_has_not()
    {
        $config = new Config;

        $this->assertEquals(false, $config->has('foo'));
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
    function test_remove()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals(true, $config->has('foo'));

        $config->remove('foo');

        $this->assertEquals(false, $config->has('foo'));
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
    function test_set()
    {
        $config = new Config;

        $this->assertEquals('bar', $config->set('foo', 'bar'));
    }

    /**
     *
     */
    function test_valid_array()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    function test_valid_not_array()
    {
        $config = new Config;

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    function test_valid_with_iterator()
    {
        $config = new Config(new Config(['foo' => 'bar']));

        $this->assertEquals(true, $config->valid());
    }

    /**
     *
     */
    function test_valid_not_with_iterator()
    {
        $config = new Config(new Config);

        $this->assertEquals(false, $config->valid());
    }

    /**
     *
     */
    function test_clone_array_config()
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
    function test_clone_object_config()
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
