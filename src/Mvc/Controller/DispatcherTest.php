<?php

namespace Mvc5\Test\Mvc\Controller;

use Mvc5\Mvc\Controller\Dispatcher;
use Mvc5\Test\Test\TestCase;

class DispatcherTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Dispatcher::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('controller')
             ->will($this->returnArgument(0));

        $mock->expects($this->once())
             ->method('dispatch')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $mock = $this->getCleanMock(Dispatcher::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('controller')
             ->will($this->returnArgument(0));

        $mock->expects($this->once())
             ->method('dispatch')
             ->will($this->throwException(new \Exception));

        $mock->expects($this->once())
             ->method('exception')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }
}
