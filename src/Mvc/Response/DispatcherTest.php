<?php

namespace Mvc5\Test\Mvc\Layout;

use Mvc5\Mvc\Response\Dispatcher;
use Mvc5\Response\Response;
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

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('send')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke($response));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $mock = $this->getCleanMock(Dispatcher::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $mock->method('send')
             ->will($this->onConsecutiveCalls($this->throwException(new \Exception), 'foo'));

        $mock->expects($this->once())
             ->method('exception')
             ->willReturn($response);

        $this->assertEquals('foo', $mock->__invoke($response));
    }
}
