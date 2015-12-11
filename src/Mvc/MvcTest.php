<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Test\Test\TestCase;
use Mvc5\Response\Response;
use Mvc5\Route\Route;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class MvcTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Mvc|Mock $mock */

        $mock = $this->getCleanMock(Mvc::class, ['args', 'argsTest']);

        $this->assertTrue(is_array($mock->argsTest()));
    }

    /**
     *
     */
    public function test_invoke_response()
    {
        /** @var Mvc|Mock $mock */

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
        /** @var Mvc|Mock $mock */

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
        /** @var Mvc|Mock $mock */

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
        /** @var Mvc|Mock $mock */

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
