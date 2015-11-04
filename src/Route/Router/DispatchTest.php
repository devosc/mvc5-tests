<?php

namespace Mvc5\Test\Route\Router;

use Mvc5\Route\Router\Dispatch;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $route = $this->getCleanMock(Route::class);

        $dispatch = new Dispatch($route);

        $this->assertInstanceOf(Dispatch::class, $dispatch);
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsDispatch::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Dispatch::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_route()
    {
        $mock = $this->getCleanMock(Dispatch::class, ['__invoke']);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($route);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('stop');

        $this->assertInstanceOf(Route::class, $mock->__invoke(function() {}));
    }
}
