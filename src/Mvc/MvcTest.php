<?php

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Mvc;
use Mvc5\Response\Response;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class MvcTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsMvc::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }

    /**
     *
     */
    public function test_invoke_response()
    {
        $mock = $this->getCleanMock(Mvc::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('setModel');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_false_response()
    {
        $mock = $this->getCleanMock(Mvc::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn(false);

        $this->assertEquals(false, $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_route_response()
    {
        $mock = $this->getCleanMock(Mvc::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($route);

        $mock->expects($this->once())
             ->method('setRoute');

        $this->assertEquals($route, $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_response_response()
    {
        $mock = $this->getCleanMock(Mvc::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($response);

        $mock->expects($this->once())
             ->method('setResponse');

        $this->assertEquals($response, $mock->__invoke(function() {}));
    }
}
