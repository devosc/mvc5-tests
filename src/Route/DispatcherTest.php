<?php

namespace Mvc5\Test\Route;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DispatcherTest
    extends TestCase
{
    /**
     *
     */
    public function test_definition()
    {
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['definition', 'definitionTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->definitionTest([]));
    }

    /**
     *
     */
    public function test_match()
    {
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['match', 'matchTest']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->matchTest(null, null));
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

    /**
     *
     */
    public function test_route()
    {
        /** @var Dispatcher|Mock $mock */

        $mock = $this->getCleanAbstractMock(Dispatcher::class, ['route', 'routeTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->routeTest(null));
    }
}
