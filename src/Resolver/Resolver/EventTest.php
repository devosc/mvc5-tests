<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class EventTest
    extends TestCase
{
    /**
     *
     */
    public function test_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['event', 'eventTest']);

        $event = $this->getCleanMock(Event::class);

        $this->assertEquals($event, $mock->eventTest($event));
    }

    /**
     *
     */
    public function test_not_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['event', 'eventTest']);

        $event = null;

        $mock->expects($this->once())
            ->method('create')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->eventTest($event));
    }
}
