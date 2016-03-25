<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\Dispatch;
use Mvc5\Response\Error;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['__invoke', 'args']);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
            ->method('signal')
            ->willReturn($route);

        $mock->expects($this->once())
            ->method('stop');

        $this->assertEquals($route, $mock->__invoke(function(){}));
    }

    /**
     *
     */
    public function test_invoke_error()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['__invoke', 'args']);

        $error = $this->getCleanMock(Error::class);

        $error->expects($this->once())
              ->method('status');

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($error);

        $this->assertEquals($error, $mock->__invoke(function(){}));
    }
}
