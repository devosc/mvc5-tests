<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

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

        $mock = $this->getCleanAbstractMock(Resolver::class, ['event', 'eventTest']);

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->eventTest('foo'));
    }
}
