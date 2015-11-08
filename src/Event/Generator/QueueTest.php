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

        $this->assertEquals($event, $mock->testQueue($event));
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
             ->method('listeners')
             ->willReturn(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $mock->testQueue($event));
    }

    /**
     *
     */
    public function test_queue_not_traversable_event_string()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['queue', 'testQueue']);

        $event = 'bar';

        $mock->expects($this->once())
             ->method('listeners')
             ->willReturn(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $mock->testQueue($event));
    }

    /**
     *
     */
    public function test_queue_not_traversable_event_object()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['queue', 'testQueue']);

        $mock->expects($this->once())
             ->method('listeners')
             ->willReturn(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $mock->testQueue(new \stdClass));
    }
}
