<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Error;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Dispatch::class, new Dispatch('foo'));
    }

    /**
     *
     */
    public function test_args()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['args', 'argsTest']);

        $this->assertTrue(is_array($mock->argsTest()));
    }

    /**
     *
     */
    public function test_invoke_response()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($response);

        $this->assertEquals($response, $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_error()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $error = $this->getCleanMock(Error::class);

        $error->expects($this->once())
              ->method('status');

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($error);

        $this->assertEquals($error, $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_not_response()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }
}
