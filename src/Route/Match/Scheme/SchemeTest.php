<?php

namespace Mvc5\Test\Route\Match\Scheme;

use Mvc5\Route\Match\Scheme\Scheme;
use Mvc5\Route\Route;
use Mvc5\Route\Definition\Definition;
use Mvc5\Test\Test\TestCase;

class SchemeTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('scheme')
              ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('scheme')
                   ->willReturn('foo');

        $this->assertEquals($route, (new Scheme)->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_not_matched()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('scheme')
              ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('scheme')
                   ->willReturn('bar');

        $this->assertEquals(null, (new Scheme)->__invoke($route, $definition));
    }
}
