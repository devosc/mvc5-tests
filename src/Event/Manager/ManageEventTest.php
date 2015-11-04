<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Test\Test\TestCase;

class ManageEventTest
    extends TestCase
{
    /**
     *
     */
    public function test_events()
    {
        $mock = $this->getCleanAbstractMock(ManageEvent::class, ['events']);

        $this->assertEquals(null, $mock->events(null));
    }

    /**
     *
     */
    public function test_listeners()
    {
        $mock = $this->getCleanAbstractMock(ManageEvent::class, ['listeners', 'testListeners']);

        $this->assertEquals(null, $mock->testListeners());
    }

    /**
     *
     */
    public function test_trigger()
    {
        $mock = $this->getCleanAbstractMock(ManageEvent::class, ['trigger']);

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->trigger('foo'));
    }
}
