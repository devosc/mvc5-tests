<?php

namespace Mvc5\Test\Route\Exception\Manager;

use Mvc5\Route\Exception\Manager\Controller;
use Mvc5\Route\Exception\RouteException;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Controller::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('exception')
             ->willReturn('foo');

        $exception = $this->getCleanMock(RouteException::class);

        $exception->expects($this->once())
                  ->method('route')
                  ->willReturn($this->getCleanMock(Route::class));

        $exception->expects($this->once())
                  ->method('exception')
                  ->willReturn(new \Exception);

        $this->assertEquals('foo', $mock->__invoke($exception));
    }
}
