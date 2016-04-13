<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CloneTest
    extends TestCase
{
    /**
     *
     */
    public function test_clone_with_arrays()
    {
        $resolver = new Resolver;

        $clone = clone $resolver;

        $this->assertEquals(true, $clone == $resolver);

        $clone->config(['foo' => 'bar']);
        $clone->set('a', 'a');
        $clone->events(['b' => 'b']);
        $clone->configure('baz', 'bat');

        $this->assertEquals(false, $clone == $resolver);

        $this->assertEquals([], $resolver->config());
        $this->assertEquals([], $resolver->events());
        $this->assertEquals([], $resolver->container());
        $this->assertEquals([], $resolver->services());

        $this->assertEquals(['foo' => 'bar'], $clone->config());
        $this->assertEquals(['a' => 'a'],     $clone->container());
        $this->assertEquals(['b' => 'b'],     $clone->events());
        $this->assertEquals(['baz' => 'bat'], $clone->services());
    }

    /**
     *
     */
    public function test_clone_with_objects()
    {
        $resolver = new Resolver;

        $resolver->config(new Config);
        $resolver->container(new Config);
        $resolver->events(new Config);
        $resolver->services(new Config);

        $clone = clone $resolver;

        $this->assertEquals(true, $clone == $resolver);

        $config    = $clone->config();
        $container = $clone->container();
        $events    = $clone->events();
        $services  = $clone->services();

        $config['foo']   = 'bar';
        $container['a']  = 'a';
        $events['b']     = 'b';
        $services['baz'] = 'bat';

        $this->assertEquals(false, $clone == $resolver);

        $this->assertEquals(new Config, $resolver->config());
        $this->assertEquals(new Config, $resolver->container());
        $this->assertEquals(new Config, $resolver->events());
        $this->assertEquals(new Config, $resolver->services());

        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
        $this->assertEquals(new Config(['a' => 'a']),     $clone->container());
        $this->assertEquals(new Config(['b' => 'b']),     $clone->events());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());
    }

    /**
     *
     */
    public function test_clone_scope_object()
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
    public function test_clone_same_provider()
    {
        $resolver = new Resolver;

        $provider = function(){};

        $resolver->setProvider($provider);

        $clone = clone $resolver;

        $this->assertEquals(true, $clone->provider() === $resolver->provider());
    }
}
