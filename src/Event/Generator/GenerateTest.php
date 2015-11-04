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

        $mock->expects($this->once())
             ->method('queue')
             ->willReturn([function() {}]);

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

        $mock->expects($this->once())
             ->method('emit')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('queue')
             ->willReturn([function() {}]);

        $this->assertEquals('foo', $mock->testGenerate($event));
    }
}
