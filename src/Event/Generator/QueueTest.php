<?php

namespace Mvc5\Test\Event\Generator;

use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;

class QueueTest
    extends TestCase
{
    /**
     *
     */
    public function test_queue_traversable()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['queue', 'testQueue']);

        $event = $this->getCleanMock(\Traversable::class);

        $mock->expects($this->once())
             ->method('traverse')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testQueue($event));
    }

    /**
     *
     */
    public function test_queue_not_traversable_event()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['queue', 'testQueue']);

        $event = $this->getCleanMock(Event::class);

        $event->expects($this->once())
              ->method('event')
              ->willReturn('bar');

        $mock->expects($this->once())
             ->method('traverse')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('listeners')
             ->willReturn(['bar' => 'baz']);

        $this->assertEquals('foo', $mock->testQueue($event));
    }

    /**
     *
     */
    public function test_queue_not_traversable_event_string()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['queue', 'testQueue']);

        $event = 'bar';

        $mock->expects($this->once())
             ->method('traverse')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('listeners')
             ->willReturn(['bar' => 'baz']);

        $this->assertEquals('foo', $mock->testQueue($event));
    }

    /**
     *
     */
    public function test_queue_not_traversable_event_object()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['queue', 'testQueue']);

        $event = new \stdClass;

        $mock->expects($this->once())
             ->method('traverse')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('listeners')
             ->willReturn(['stdClass' => 'baz']);

        $this->assertEquals('foo', $mock->testQueue($event));
    }
}
