<?php

namespace Mvc5\Test\Event\Generator;

use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;

class GenerateTest
    extends TestCase
{
    /**
     *
     */
    public function test_generate()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['generate', 'testGenerate']);

        $mock->expects($this->once())
             ->method('emit')
             ->willReturn('foo');

        $listener = function() {};

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn($listener);

        $mock->expects($this->once())
             ->method('queue')
             ->willReturn([$listener]);

        $this->assertEquals('foo', $mock->testGenerate(null));
    }

    /**
     *
     */
    public function test_generate_event_stopped()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['generate', 'testGenerate']);

        $event = $this->getCleanMock(Event::class);

        $event->expects($this->once())
              ->method('stopped')
              ->willReturn(true);

        $listener = function() {};

        $mock->expects($this->once())
             ->method('emit')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn($listener);

        $mock->expects($this->once())
             ->method('queue')
             ->willReturn([$listener]);

        $this->assertEquals('foo', $mock->testGenerate($event));
    }
}
