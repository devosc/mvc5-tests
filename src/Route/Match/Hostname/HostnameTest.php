<?php

namespace Mvc5\Test\Route\Match\Hostname;

use Mvc5\Route\Match\Hostname\Hostname;
use Mvc5\Route\Route;
use Mvc5\Route\Definition\Definition;
use Mvc5\Test\Test\TestCase;

class HostnameTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('hostname')
              ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('hostname')
                   ->willReturn('foo');

        $this->assertEquals($route, (new Hostname)->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_not_matched()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('hostname')
              ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('hostname')
                   ->willReturn('bar');

        $this->assertEquals(null, (new Hostname)->__invoke($route, $definition));
    }
}
