<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Immutable;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
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

        $this->assertNull($config->get('foo'));
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

        $this->assertNull($config->get('foo'));
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

        $this->assertNull($config->get('foo'));
    }

    /**
     *
     */
    function test_has()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue($config->has('foo'));
    }

    /**
     *
     */
    function test_has_not()
    {
        $config = new Config;

        $this->assertFalse($config->has('foo'));
    }

    /**
     *
     */
    function test_remove()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue($config->has('foo'));

        $config->remove('foo');

        $this->assertFalse($config->has('foo'));
    }

    /**
     *
     */
    function test_remove_array()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertTrue($config->has('foo'));
        $this->assertTrue($config->has('baz'));

        $config->remove(['foo', 'baz']);

        $this->assertFalse($config->has('foo'));
        $this->assertFalse($config->has('baz'));
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
    function test_set_array()
    {
        $config = new Config;

        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $config->set(['foo' => 'bar', 'baz' => 'bat']));
    }

    /**
     *
     */
    function test_with()
    {
        $config = new Config(['baz' => 'bat']);

        $new = $config->with('foo', 'bar');

        $this->assertNotEquals($new, $config);
        $this->assertNull($config->get('foo'));
        $this->assertEquals('bar', $new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_with_array()
    {
        $config = new Config;

        $new = $config->with(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertNotEquals($new, $config);
        $this->assertEquals('bar', $new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_with_config()
    {
        $config = new Config(new Config(['baz' => 'bat']));

        $new = $config->with('foo', 'bar');

        $this->assertNotEquals($new, $config);
        $this->assertNull($config->get('foo'));
        $this->assertEquals('bar', $new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_with_immutable()
    {
        $config = new Config(new Immutable(['baz' => 'bat']));

        $new = $config->with('foo', 'bar');

        $this->assertNotEquals($new, $config);
        $this->assertNull($config->get('foo'));
        $this->assertEquals('bar', $new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_without()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $new = $config->without('foo');

        $this->assertNotEquals($new, $config);
        $this->assertEquals('bar', $config->get('foo'));
        $this->assertNull($new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_without_array()
    {
        $config = new Config(['foo' => 'bar', 'baz' => 'bat']);

        $new = $config->without(['foo', 'baz']);

        $this->assertFalse($new->has('foo'));
        $this->assertFalse($new->has('baz'));
    }

    /**
     *
     */
    function test_without_config()
    {
        $config = new Config(new Config(['foo' => 'bar', 'baz' => 'bat']));

        $new = $config->without('foo');

        $this->assertNotEquals($new, $config);
        $this->assertEquals('bar', $config->get('foo'));
        $this->assertNull($new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_without_immutable()
    {
        $config = new Config(new Immutable(['foo' => 'bar', 'baz' => 'bat']));

        $new = $config->without('foo');

        $this->assertNotEquals($new, $config);
        $this->assertEquals('bar', $config->get('foo'));
        $this->assertNull($new->get('foo'));
        $this->assertEquals('bat', $new->get('baz'));
    }

    /**
     *
     */
    function test_clone_array_config()
    {
        $config = new Config(['a' => 'a']);

        $clone = clone $config;

        $this->assertEquals($clone, $config);

        $clone['a'] = 'a1';
        $clone['b'] = 'b';

        $this->assertNotEquals($clone, $config);
        $this->assertEquals('a', $config['a']);
        $this->assertEquals('a1', $clone['a']);
        $this->assertFalse(isset($config['b']));
        $this->assertTrue(isset($clone['b']));
        $this->assertNotSame($clone, $config);
    }

    /**
     *
     */
    function test_clone_object_config()
    {
        $config = new Config(new Config(['a' => 'a']));

        $clone = clone $config;

        $this->assertEquals($clone, $config);

        $clone['a'] = 'a1';
        $clone['b'] = 'b';

        $this->assertNotEquals($clone, $config);
        $this->assertEquals('a', $config['a']);
        $this->assertEquals('a1', $clone['a']);
        $this->assertFalse(isset($config['b']));
        $this->assertTrue(isset($clone['b']));
    }

    /**
     *
     */
    function test_clone_not_object()
    {
        $config = new Config;

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    function test_clone_object_not_scoped()
    {
        $config = new Config(new Config);

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    function test_clone_object_scoped()
    {
        $plugins = new App;

        $config = new Config($plugins);

        $plugins->scope($config);

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    function test_clone_object_scoped_true()
    {
        $plugins = new App(null, null, true);

        $config = new Config($plugins);

        $this->assertEquals(clone $config, $config);
    }

    /**
     *
     */
    function test_clone_object_scoped_different_object()
    {
        $plugins = new App;

        $config = new Config($plugins);

        $plugins->scope(new \stdClass);

        $this->assertEquals(clone $config, $config);
    }
}
