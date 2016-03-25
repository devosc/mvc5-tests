<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Response\Error\NotFound;
use Mvc5\Route\Error\Create;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Create::class, new Create('foo', 'bar'));
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->any())
              ->method('offsetSet');

        /** @var Create|Mock $mock */

        $mock = $this->getCleanMock(Create::class, ['__invoke'], ['foo', 'bar']);

        $this->assertEquals($route, $mock->__invoke($route, new NotFound));
    }
}
