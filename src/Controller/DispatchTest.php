<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_action()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatch::class, ['action', 'actionTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->actionTest(function() {}));
    }

    /**
     *
     */
    public function test_controller()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatch::class, ['controller', 'controllerTest']);

        $mock->expects($this->once())
             ->method('invokable')
             ->willReturn(function(){});

        $this->assertInstanceOf(\Closure::class, $mock->controllerTest(function() {}));
    }

    /**
     *
     */
    public function test_dispatch()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatch::class, ['dispatch', 'dispatchTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->dispatchTest(function() {}));
    }

    /**
     *
     */
    public function test_exception()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatch::class, ['exception', 'exceptionTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->exceptionTest(new \Exception, null));
    }
}
