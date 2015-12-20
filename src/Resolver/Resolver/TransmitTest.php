<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class TransmitTest
    extends TestCase
{
    /**
     *
     */
    public function test_transmit()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['transmit', 'transmitTest']);

        $mock->expects($this->once())
             ->method('relay')
             ->willReturn('bar');

        $mock->expects($this->once())
             ->method('invokable');

        $this->assertEquals('bar', $mock->transmitTest(['foo']));
    }
}
