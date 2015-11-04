<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Event\Manager\ManageEvent as Base;
use Mvc5\Test\Test\TestCase;

class TriggerTest
    extends TestCase
{
    /**
     *
     */
    public function test_trigger()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['trigger']);

        $mock->expects($this->once())
             ->method('event');

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->trigger(null));
    }
}
