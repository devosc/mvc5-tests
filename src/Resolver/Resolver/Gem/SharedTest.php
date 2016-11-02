<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Args;
use Mvc5\Plugin\Shared;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class SharedTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_shared()
    {
        $resolver = new Resolver;

        $resolver->set('foo', 'bar');

        $this->assertEquals('bar', $resolver->gem(new Shared('foo')));

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    function test_gem_shared_create()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->gem(new Shared('foo', function() { return 'bar'; })));

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    function test_gem_shared_with_config()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->gem(new Shared('foo', new Args('bar'))));

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    function test_gem_shared_not_null()
    {
        $resolver = new Resolver;

        $value = 0;

        $this->assertTrue(false === $resolver->has('foo'));

        $this->assertTrue($value === $resolver->gem(new Shared('foo', new Args($value))));

        $this->assertTrue(true === $resolver->has('foo'));

        $this->assertTrue(['foo' => $value] === $resolver->container());

        $this->assertTrue($value === $resolver->gem(new Shared('foo')));
    }

    /**
     *
     */
    function test_gem_shared_null()
    {
        $resolver = new Resolver;

        $this->assertEquals(null, $resolver->gem(new Shared('foo', new Args(null))));

        $this->assertTrue(false === $resolver->has('foo'));
    }
}
