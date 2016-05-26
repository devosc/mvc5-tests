<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Event;
use Mvc5\Plugin\Invoke;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    function test_call_string()
    {
        $resolver = new Resolver;

        $this->assertEquals(phpversion(), $resolver->call('@phpversion'));
    }

    /**
     *
     */
    function test_call_event()
    {
        $resolver = new Resolver;

        $resolver->events(['foo' => [function() { return 'bar'; }]]);

        $this->assertEquals('bar', $resolver->call(new Event('foo')));
    }

    /**
     *
     */
    function test_call_invoke_resolvable_plugin()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->call(new Invoke(function() { return 'foo';})));
    }

    /**
     *
     */
    function test_call_invoke_not_resolvable()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->call(function() { return 'foo';}));
    }
}
