<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;

class EventTest
    extends TestCase
{
    /**
     *
     */
    public function test_event()
    {
        $mock = $this->getCleanAbstractMock(Events::class, ['event', 'testEvent']);

        $event = $this->getCleanMock(Event::class);

        $this->assertEquals($event, $mock->testEvent($event));
    }

    /**
     *
     */
    public function test_not_event()
    {
        $mock = $this->getCleanAbstractMock(Events::class, ['event', 'testEvent']);

        $event = null;

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testEvent($event));
    }
}
