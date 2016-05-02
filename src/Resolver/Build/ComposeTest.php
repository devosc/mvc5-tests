<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ComposeTest
    extends TestCase
{
    /**
     *
     */
    function test_compose_plugin()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->compose('foo'));
    }

    /**
     *
     */
    function test_compose_once()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->compose(['foo' => 'bar'], ['foo']));
    }
}
