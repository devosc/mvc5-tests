<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Test\Test\TestCase;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    function test_no_args()
    {
        $event = new TestEvent;

        $callable = function(TestEvent $event){
            return $event->event();
        };

        $this->assertEquals('test_event', $event($callable));
    }

    /**
     *
     */
    function test_no_string_key_args()
    {
        $event = new TestEvent;

        $callable = function($foo, $bar){
            return $foo. '/' . $bar;
        };

        $this->assertEquals('foo/bar', $event($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_string_key_args()
    {
        $event = new TestEvent;

        $callable = function(TestEvent $event, $foo){
            return $event->event() . $foo;
        };

        $this->assertEquals('test_event/bar', $event($callable, ['foo' => '/bar']));
    }
}
