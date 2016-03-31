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
    public function test_event()
    {
        $event = new Event('foo');

        $this->assertEquals('foo', $event->event());
    }

    /**
     *
     */
    public function test_event_const()
    {
        $event = new Event;

        $this->assertEquals('baz', $event->event());
    }

    /**
     *
     */
    public function test_event_class_name()
    {
        $event = new ModelEvent;

        $this->assertEquals(get_class($event), $event->event());
    }

    /**
     *
     */
    public function test_stop()
    {
        $event = new ModelEvent;

        $this->assertFalse($event->stopped());

        $event->stop();

        $this->assertTrue($event->stopped());
    }

    /**
     *
     */
    public function test_stopped()
    {
        $event = new ModelEvent;

        $this->assertFalse($event->stopped());
    }
}
