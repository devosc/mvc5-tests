<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Args;
use Mvc5\Plugin\Dependency;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class DependencyTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_dependency_shared()
    {
        $resolver = new Resolver;

        $resolver->set('foo', 'bar');

        $this->assertEquals('bar', $resolver->gem(new Dependency('foo')));

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    function test_gem_dependency_create()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->gem(new Dependency('foo', function() { return 'bar'; })));

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    function test_gem_dependency()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->gem(new Dependency('foo', new Args('bar'))));

        $this->assertEquals('bar', $resolver->get('foo'));
    }

    /**
     *
     */
    function test_gem_dependency_not_null()
    {
        $resolver = new Resolver;

        $value = 0;

        $this->assertTrue(false === $resolver->has('foo'));

        $this->assertTrue($value === $resolver->gem(new Dependency('foo', new Args($value))));

        $this->assertTrue(true === $resolver->has('foo'));

        $this->assertTrue(['foo' => $value] === $resolver->container());

        $this->assertTrue($value === $resolver->gem(new Dependency('foo')));
    }

    /**
     *
     */
    function test_gem_dependency_null()
    {
        $resolver = new Resolver;

        $this->assertEquals(null, $resolver->gem(new Dependency('foo', new Args(null))));

        $this->assertTrue(false === $resolver->has('foo'));
    }
}
