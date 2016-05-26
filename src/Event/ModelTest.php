<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_event()
    {
        $event = new TestEvent('foo');

        $this->assertEquals('foo', $event->event());
    }

    /**
     *
     */
    function test_event_const()
    {
        $event = new TestEvent;

        $this->assertEquals('test_event', $event->event());
    }

    /**
     *
     */
    function test_event_class_name()
    {
        $event = new TestEventNoName;

        $this->assertEquals(get_class($event), $event->event());
    }

    /**
     *
     */
    function test_stop()
    {
        $event = new TestEvent;

        $this->assertFalse($event->stopped());

        $event->stop();

        $this->assertTrue($event->stopped());
    }

    /**
     *
     */
    function test_stopped()
    {
        $event = new TestEvent;

        $this->assertFalse($event->stopped());
    }
}
