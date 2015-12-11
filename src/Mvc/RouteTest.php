<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Route as MvcRoute;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RouteTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var MvcRoute|Mock $mock */

        $mock = $this->getCleanMock(MvcRoute::class, ['__invoke']);

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
        /** @var MvcRoute|Mock $mock */

        $mock = $this->getCleanMock(MvcRoute::class, ['__invoke']);

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
