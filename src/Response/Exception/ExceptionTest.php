<?php

namespace Mvc5\Test\Response\Exception;

use Mvc5\Response\Exception\Exception;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $exception = $this->getCleanMock(\Exception::class);
        $response  = $this->getCleanMock(Response::class);

        $exception = new Exception($response, $exception);

        $this->assertInstanceOf(Exception::class, $exception);
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Exception::class, ['__invoke', 'args']);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_with_response()
    {
        $mock = $this->getCleanMock(Exception::class, ['__invoke', 'args']);

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($response);

        $this->assertInstanceOf(Response::class, $mock->__invoke(function() {}));
    }
}
