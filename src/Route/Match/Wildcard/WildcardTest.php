<?php

namespace Mvc5\Test\Route\Match\Scheme;

use Mvc5\Route\Match\Wildcard\Wildcard;
use Mvc5\Route\Route;
use Mvc5\Route\Definition\Definition;
use Mvc5\Test\Test\TestCase;

class WildcardTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('path')
              ->willReturn('/foo/bar');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('wildcard')
                   ->willReturn(true);

        $this->assertEquals($route, (new Wildcard)->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_invalid_pair()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('path')
              ->willReturn('/foo/bar/baz');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('wildcard')
                   ->willReturn(true);

        $this->assertEquals($route, (new Wildcard)->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_not_matched()
    {
        $route = $this->getCleanMock(Route::class);

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('wildcard')
                   ->willReturn(false);

        $this->assertEquals($route, (new Wildcard)->__invoke($route, $definition));
    }
}
