<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ScopeTest
    extends TestCase
{
    /**
     *
     */
    function test_scope_null()
    {
        $resolver = new Resolver;

        $this->assertEquals(null, $resolver->scope());
    }

    /**
     *
     */
    function test_scope_set()
    {
        $resolver = new Resolver;

        $config = new Config;

        $this->assertTrue($config === $resolver->scope($config));
    }

    /**
     *
     */
    function test_scope_exists()
    {
        $resolver = new Resolver;

        $config = new Config;

        $resolver->scope($config);

        $this->assertTrue($config === $resolver->scope());
    }
}
