<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Signal|Mock $mock */

        $mock = $this->getCleanAbstractMock(Signal::class, ['args', 'argsTest']);

        $this->assertEquals([Arg::EVENT => $mock], $mock->argsTest());
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Signal|Mock $mock */

        $mock = $this->getCleanAbstractMock(Signal::class, ['__invoke']);

        $mock->expects($this->once())
            ->method('args')
            ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function(){}));
    }
}
