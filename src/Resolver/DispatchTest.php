<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Dispatch $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['args', 'argsTest']);

        $this->assertEquals([Arg::EVENT => $mock], $mock->argsTest());
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Dispatch|Mock $mock */

        $mock = $this->getCleanMock(Dispatch::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($route);

        $mock->expects($this->once())
             ->method('stop');

        $this->assertEquals($route, $mock->__invoke(function(){}));
    }
}
