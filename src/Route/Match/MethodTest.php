<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Response\Error\MethodNotAllowed;
use Mvc5\Route\Match\Method;
use Mvc5\Route\Route;
use Mvc5\Route\Definition;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class MethodTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('method')
              ->willReturn('foo');

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('method')
                   ->willReturn('foo');

        $this->assertEquals($route, (new Method)->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_not_matched()
    {
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
            ->method('method')
            ->willReturn('foo');

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
            ->method('method')
            ->willReturn('bar');

        $this->assertInstanceOf(MethodNotAllowed::class, (new Method)->__invoke($route, $definition));
    }
}
