<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->invoke(function() { return 'foo'; }));
    }
}
