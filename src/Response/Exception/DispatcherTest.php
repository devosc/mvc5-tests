<?php

namespace Mvc5\Test\Response\Exception;

use Mvc5\Response\Exception\Dispatcher;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class DispatcherTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Dispatcher::class, new Dispatcher(200));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Dispatcher::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setStatus')
                 ->will($this->returnArgument(0));

        $this->assertInstanceOf(Response::class, $mock->__invoke($response));
    }
}
