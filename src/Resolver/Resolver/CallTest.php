<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Event;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_call_string()
    {
        $resolver = new Resolver;

        $this->assertEquals(phpversion(), $resolver->call('@phpversion'));
    }

    /**
     *
     */
    public function test_call_event()
    {
        $resolver = new Resolver;

        $resolver->events(['foo' => [function() { return 'bar'; }]]);

        $this->assertEquals('bar', $resolver->call(new Event('foo')));
    }

    /**
     *
     */
    public function test_call_invoke()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->call(function() { return 'foo';}));
    }
}
