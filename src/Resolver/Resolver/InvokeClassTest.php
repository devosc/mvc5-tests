<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class InvokeClassTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver(Config::class));
    }

    /**
     *
     */
    function test_invoke_with_provider()
    {
        $resolver = new Resolver;

        $resolver->setProvider(function() { return 'bar'; });

        $this->assertEquals('bar', $resolver('foo'));
    }

    /**
     *
     */
    function test_invoke_with_empty_function()
    {
        $resolver = new Resolver;

        $this->assertNull($resolver('foo'));
    }
}
