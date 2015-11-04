<?php

namespace Mvc5\Test\Mvc\Route;

use Mvc5\Mvc\Route\Router;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class RouterTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Router::class, ['__invoke']);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
             ->method('route')
             ->will($this->returnArgument(0))
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke($route));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $mock = $this->getCleanMock(Router::class, ['__invoke']);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
             ->method('route')
             ->will($this->throwException(new \Exception));

        $mock->expects($this->once())
             ->method('exception')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke($route));
    }
}
