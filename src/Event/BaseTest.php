<?php

namespace Mvc5\Test\Event;

use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_event()
    {
        $mock = $this->getCleanMock(EventName::class, ['event'], ['foo']);

        $this->assertEquals('foo', $mock->event());
    }

    /**
     *
     */
    public function test_event_const()
    {
        $mock = $this->getCleanMock(EventConstantName::class, ['event']);

        $this->assertEquals('foo', $mock->event());
    }

    /**
     *
     */
    public function test_event_classname()
    {
        $mock = $this->getCleanMock(Event::class, ['event']);

        $this->assertEquals(get_class($mock), $mock->event());
    }

    /**
     *
     */
    public function test_event_stop()
    {
        $mock = $this->getCleanMock(Event::class, ['stop']);

        $this->assertEquals(null, $mock->stop());
    }

    /**
     *
     */
    public function test_event_stopped()
    {
        $mock = $this->getCleanMock(Event::class, ['stopped']);

        $this->assertEquals(false, $mock->stopped());
    }
}
