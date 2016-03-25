<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Response\Error\MethodNotAllowed;
use Mvc5\Route\Match\Allow;
use Mvc5\Route\Route;
use Mvc5\Route\Definition;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class AllowTest
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
              ->willReturn('GET');

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('allow')
                   ->willReturn(['GET']);

        $this->assertEquals($route, (new Allow)->__invoke($route, $definition));
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
              ->willReturn('POST');

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('allow')
                   ->willReturn(['GET']);

        $this->assertInstanceOf(MethodNotAllowed::class, (new Allow)->__invoke($route, $definition));
    }
}
