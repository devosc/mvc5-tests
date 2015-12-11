<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_event()
    {
        /** @var Event|Mock $mock */

        $mock = $this->getCleanMock(Event::class, ['event'], ['foo']);

        $this->assertEquals('foo', $mock->event());
    }

    /**
     *
     */
    public function test_event_const()
    {
        /** @var Event|Mock $mock */

        $mock = $this->getCleanMock(Event::class, ['event']);

        $this->assertEquals('baz', $mock->event());
    }

    /**
     *
     */
    public function test_event_class_name()
    {
        /** @var Event|Mock $mock */

        $mock = $this->getCleanMock(ModelEvent::class, ['event']);

        $this->assertEquals(get_class($mock), $mock->event());
    }

    /**
     *
     */
    public function test_stop()
    {
        /** @var Event|Mock $mock */

        $mock = $this->getCleanMock(ModelEvent::class, ['stop']);

        $mock->stop();
    }

    /**
     *
     */
    public function test_stopped()
    {
        /** @var Event|Mock $mock */

        $mock = $this->getCleanMock(ModelEvent::class, ['stopped']);

        $this->assertEquals(false, $mock->stopped());
    }
}
