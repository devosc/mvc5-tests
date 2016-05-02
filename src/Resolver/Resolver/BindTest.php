<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class BindTest
    extends TestCase
{
    /**
     *
     */
    function test_bind()
    {
        $resolver = new Resolver;

        $config = new Config;

        $callback = function() { return $this; };

        $scoped = $resolver->bind($callback, $config);

        $this->assertInstanceOf(\Closure::class, $scoped);

        $this->assertTrue($config === $scoped());
    }
}
