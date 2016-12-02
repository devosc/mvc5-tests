<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class SharedTest
    extends TestCase
{
    /**
     *
     */
    function test_shared()
    {
        $resolver = new Resolver;

        $resolver->set('foo', 'bar');

        $this->assertEquals('bar', $resolver->shared('foo'));
    }

    /**
     *
     */
    function test_shared_set()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->shared('foo', function() { return 'bar'; }));
    }
}
