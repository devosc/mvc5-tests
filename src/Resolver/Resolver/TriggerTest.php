<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class TriggerTest
    extends TestCase
{
    /**
     *
     */
    public function test_trigger()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['trigger']);

        $mock->expects($this->any())
            ->method('event')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('generate')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->trigger(null));
    }
}
