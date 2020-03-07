<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;

class EventModelTest
    extends TestCase
{
    /**
     *
     */
    function test_named_args()
    {
        $event = new TestEvent;

        $callable = fn($foo) => 'foo' . $foo;

        $this->assertEquals('foo/bar', $event($callable, ['foo' => '/bar']));
    }

    /**
     *
     */
    function test_no_args()
    {
        $event = new TestEvent;

        $callable = fn(Event $event) => $event->name();

        $this->assertEquals(TestEvent::class, $event($callable));
    }

    /**
     *
     */
    function test_numeric_args()
    {
        $event = new TestEvent;

        $callable = fn($foo, $bar) => $foo. '/' . $bar;

        $this->assertEquals('foo/bar', $event($callable, ['foo', 'bar']));
    }
}
