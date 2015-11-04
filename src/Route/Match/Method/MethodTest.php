<?php

namespace Mvc5\Test\Route\Match\Method;

use Mvc5\Route\Match\Method\Method;
use Mvc5\Route\Route;
use Mvc5\Route\Definition\Definition;
use Mvc5\Test\Test\TestCase;

class MethodTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('method')
              ->willReturn('foo');

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
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
            ->method('method')
            ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
            ->method('method')
            ->willReturn('bar');

        $this->assertEquals(null, (new Method)->__invoke($route, $definition));
    }
}
