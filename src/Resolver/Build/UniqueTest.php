<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class UniqueTest
    extends TestCase
{
    /**
     *
     */
    function test_unique_same()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->unique(Config::class, Config::class));
    }

    /**
     *
     */
    function test_unique_null_parent()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->unique(Config::class, null));
    }

    /**
     *
     */
    function test_unique_parent()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->unique('foo', Config::class));
    }

    /**
     *
     */
    function test_unique_callback()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->unique('foo', 'bar', [], function() { return new Config; }));
    }
}
