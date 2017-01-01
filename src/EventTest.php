<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Event;
use Mvc5\Test\Test\TestCase;

class EventTest
    extends TestCase
{
    /**
     *
     */
    function test_name()
    {
        $event = new Event('foo');

        $this->assertEquals('foo', $event->event());
    }

    /**
     *
     */
    function test_named()
    {
        $event = new Event;

        $this->assertEquals('bar', $event(function($bar, $foo) { return $foo; }, ['foo' => 'bar', 'bar' => 'baz']));
    }

    /**
     *
     */
    function test_numeric()
    {
        $event = new Event;

        $this->assertEquals('baz', $event(function($bar, $foo) { return $foo; }, ['bar', 'baz']));
    }

    /**
     *
     */
    function test_stopped()
    {
        $event = new Event;

        $event(function(Event $event) { $event->stop(); });

        $this->assertTrue($event->stopped());
    }
}
