<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Invoke;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_invoke_named()
    {
        $resolver = new Resolver;

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['baz' => 's']);

        $callable = $resolver->gem($invoke);

        $this->assertEquals('foobars', $resolver->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    function test_gem_invoke_not_named()
    {
        $resolver = new Resolver;

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['s']);

        $callable = $resolver->gem($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $resolver->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_gem_invoke_merge()
    {
        $resolver = new Resolver;

        $invoke = new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; }, ['s']);

        $callable = $resolver->gem($invoke);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $resolver->call($callable, ['foo', 'bar']));
    }
}
