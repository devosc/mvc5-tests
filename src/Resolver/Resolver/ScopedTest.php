<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ScopedTest
    extends TestCase
{
    /**
     *
     */
    public function test_scoped_none()
    {
        $resolver = new Resolver;

        $callback = function(){};

        $this->assertTrue($callback === $resolver->scoped($callback));
    }

    /**
     *
     */
    public function test_scoped_with_scope()
    {
        $config = new Config;

        $resolver = new Resolver;

        $resolver->scope($config);

        $callback = function(){ return $this; };

        $scoped = $resolver->scoped($callback);

        $this->assertInstanceOf(\Closure::class, $scoped);

        $this->assertTrue($config === $scoped());
    }
}
