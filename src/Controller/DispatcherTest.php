<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DispatcherTest
    extends TestCase
{
    /**
     *
     */
    public function test_action()
    {
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['action', 'actionTest']);

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
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['controller', 'controllerTest']);

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
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['dispatch', 'dispatchTest']);

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
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['exception', 'exceptionTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->exceptionTest(new \Exception, null));
    }
}
