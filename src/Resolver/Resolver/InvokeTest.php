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
    function test_invoke()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->invoke(function() { return 'foo'; }));
    }

    /**
     *
     */
    function test_invoke_with_callback()
    {
        $resolver = new Resolver;

        $result = $resolver->invoke(function($foo) { return $foo; }, [], function() { return 'bar'; });

        $this->assertEquals('bar', $result);
    }
}
