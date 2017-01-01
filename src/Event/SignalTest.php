<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    function test_no_args()
    {
        $event = new SignalEvent;

        $callable = function(Event $event){
            return $event->event();
        };

        $this->assertEquals(SignalEvent::class, $event($callable));
    }

    /**
     *
     */
    function test_numeric_args()
    {
        $event = new SignalEvent;

        $callable = function($foo, $bar){
            return $foo. '/' . $bar;
        };

        $this->assertEquals('foo/bar', $event($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_named_args()
    {
        $event = new SignalEvent;

        $callable = function($foo){
            return 'foo' . $foo;
        };

        $this->assertEquals('foo/bar', $event($callable, ['foo' => '/bar']));
    }
}
