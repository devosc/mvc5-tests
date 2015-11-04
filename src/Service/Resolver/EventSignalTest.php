<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Service\Resolver\EventSignal;
use Mvc5\Test\Test\TestCase;

class EventSignalTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMockForTrait(EventSignal::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }
}
