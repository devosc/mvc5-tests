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

        $mock = $this->getCleanAbstractMock(Signal::class, ['signal', '__invoke']);

        $this->assertEquals('baz', $mock->__invoke(function($bar, $foo){ return $foo; }, ['bar', 'baz']));
    }

    /**
     *
     */
    public function test_invoke_named()
    {
        /** @var Signal|Mock $mock */

        $mock = $this->getCleanAbstractMock(Signal::class, ['signal', '__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $this->assertEquals('bar', $mock->__invoke(
            function($bar, $foo){ return $foo; }, ['bar' => 'baz', 'foo' => 'bar'])
        );
    }
}
