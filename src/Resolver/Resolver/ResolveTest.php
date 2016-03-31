<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ResolveTest
    extends TestCase
{
    /**
     *
     */
    public function test_resolve()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->resolve('foo'));
    }
}
