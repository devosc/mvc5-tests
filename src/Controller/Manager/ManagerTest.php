<?php

namespace Mvc5\Test\Controller\Manager;

use Mvc5\Controller\Manager\Manager;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    public function test_action()
    {
        $mock = $this->getCleanMock(Manager::class, ['action']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->action(function() {}));
    }

    /**
     *
     */
    public function test_controller()
    {
        $mock = $this->getCleanMock(Manager::class, ['controller']);

        $mock->expects($this->once())
             ->method('invokable')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->controller('bar'));
    }

    /**
     *
     */
    public function test_dispatch()
    {
        $mock = $this->getCleanMock(Manager::class, ['dispatch']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->dispatch(function() {}));
    }

    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Manager::class, ['exception']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->exception(new \Exception));
    }
}
