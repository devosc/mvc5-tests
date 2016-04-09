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
    public function test_invoke()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver(Config::class));
    }

    /**
     *
     */
    public function test_invoke_with_provider()
    {
        $resolver = new Resolver;

        $resolver->setProvider(function() { return 'bar'; });

        $this->assertEquals('bar', $resolver('foo'));
    }

    /**
     *
     */
    public function test_invoke_with_empty_function()
    {
        $resolver = new Resolver;

        $this->assertEquals(null, $resolver('foo'));
    }
}
