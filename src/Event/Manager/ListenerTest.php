<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Test\Test\TestCase;

class ListenerTest
    extends TestCase
{
    /**
     *
     */
    public function test_listener()
    {
        $mock = $this->getCleanAbstractMock(Events::class, ['listener', 'testListener']);

        $mock->expects($this->once())
             ->method('invokable')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testListener(null));
    }
}
