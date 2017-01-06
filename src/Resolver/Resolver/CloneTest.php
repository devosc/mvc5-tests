<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CloneTest
    extends TestCase
{
    /**
     *
     */
    function test_clone_with_arrays()
    {
        $resolver = new Resolver;

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);

        $clone->config(['foo' => 'bar']);
        $clone->set('a', 'a');
        $clone->events(['b' => 'b']);
        $clone->configure('baz', 'bat');

        $this->assertFalse($clone == $resolver);

        $this->assertEquals([], $resolver->config());
        $this->assertEquals([], $resolver->events());
        $this->assertEquals([], $resolver->container());
        $this->assertEquals([], $resolver->services());
        $this->assertEquals(['foo' => 'bar'], $clone->config());
        $this->assertEquals(['a' => 'a'], $clone->container());
        $this->assertEquals(['b' => 'b'], $clone->events());
        $this->assertEquals(['baz' => 'bat'], $clone->services());
    }

    /**
     *
     */
    function test_clone_container_array()
    {
        $resolver = new Resolver;

        $a = new \stdClass;
        $a->b = 'b';

        $resolver->container(['a' => $a]);

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);
        $this->assertInstanceOf(\stdClass::class, $clone->get('a'));
        $this->assertEquals($a, $clone->get('a'));
        $this->assertTrue($a === $clone->get('a'));
    }

    /**
     *
     */
    function test_clone_with_objects()
    {
        $resolver = new Resolver;

        $resolver->config(new Config);
        $resolver->container(new Config);
        $resolver->events(new Config);
        $resolver->services(new Config);

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);

        $config    = $clone->config();
        $container = $clone->container();
        $events    = $clone->events();
        $services  = $clone->services();

        $config['foo']   = 'bar';
        $container['a']  = 'a';
        $events['b']     = 'b';
        $services['baz'] = 'bat';

        $this->assertFalse($clone == $resolver);

        $this->assertEquals(new Config, $resolver->config());
        $this->assertEquals(new Config, $resolver->container());
        $this->assertEquals(new Config, $resolver->events());
        $this->assertEquals(new Config, $resolver->services());
        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
        $this->assertEquals(new Config(['a' => 'a']), $clone->container());
        $this->assertEquals(new Config(['b' => 'b']), $clone->events());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());
    }

    /**
     *
     */
    function test_clone_with_config_object()
    {
        $resolver = new Resolver;
        $resolver->config(new Config);

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);

        $config = $clone->config();
        $config['foo'] = 'bar';

        $this->assertFalse($clone == $resolver);
        $this->assertEquals(new Config, $resolver->config());
        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
    }

    /**
     *
     */
    function test_clone_with_container_object()
    {
        $resolver = new Resolver([Arg::CONTAINER => new Config]);

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);

        $container = $clone->container();
        $container['a'] = 'a';

        $this->assertFalse($clone == $resolver);
        $this->assertEquals(new Config, $resolver->container());
        $this->assertEquals(new Config(['a' => 'a']), $clone->container());

        $this->assertNull($clone['b']);

        $clone->config()[Arg::CONTAINER]['b'] = 'b';

        $this->assertEquals('b', $clone['b']);
        $this->assertTrue($clone->container() === $clone->config()[Arg::CONTAINER]);
    }

    /**
     *
     */
    function test_clone_with_events_object()
    {
        $resolver = new Resolver([Arg::EVENTS => new Config]);

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);

        $events = $clone->events();
        $events['a'] = 'a';

        $this->assertFalse($clone == $resolver);
        $this->assertEquals(new Config, $resolver->events());
        $this->assertEquals(new Config(['a' => 'a']), $clone->events());

        $this->assertNull($clone->events()['b']);

        $clone->config()[Arg::EVENTS]['b'] = 'b';

        $this->assertEquals('b', $clone->events()['b']);
        $this->assertTrue($clone->events() === $clone->config()[Arg::EVENTS]);
    }

    /**
     *
     */
    function test_clone_with_services_object()
    {
        $resolver = new Resolver([Arg::SERVICES => new Config]);

        $clone = clone $resolver;

        $this->assertTrue($clone == $resolver);

        $services = $clone->services();
        $services['baz'] = 'bat';

        $this->assertFalse($clone == $resolver);
        $this->assertEquals(new Config, $resolver->services());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());

        $this->assertNull($clone->services()['b']);

        $clone->config()[Arg::SERVICES]['b'] = 'b';

        $this->assertEquals('b', $clone->services()['b']);
        $this->assertTrue($clone->services() === $clone->config()[Arg::SERVICES]);
    }

    /**
     *
     */
    function test_clone_scope_object()
    {
        $resolver = new Resolver;

        $resolver->scope(new Config);

        $clone = clone $resolver;

        $this->assertTrue(is_object($clone->scope()));
        $this->assertTrue($clone->scope() !== $resolver->scope());
    }

    /**
     *
     */
    function test_clone_same_provider()
    {
        $resolver = new Resolver;

        $provider = function(){};

        $resolver->setProvider($provider);

        $clone = clone $resolver;

        $this->assertTrue($clone->provider() === $resolver->provider());
    }
}
