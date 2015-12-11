<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Route\Match\Wildcard;
use Mvc5\Route\Route;
use Mvc5\Route\Definition;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class WildcardTest
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
              ->method('path')
              ->willReturn('/foo/bar');

        /** @var Definition|Mock $definition */

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
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('path')
              ->willReturn('/foo/bar/baz');

        /** @var Definition|Mock $definition */

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
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('wildcard')
                   ->willReturn(false);

        $this->assertEquals($route, (new Wildcard)->__invoke($route, $definition));
    }
}
