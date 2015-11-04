<?php

namespace Mvc5\Test\Route\Plugin;

use Mvc5\Route\Plugin\Plugin;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Plugin::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test_invoke_no_name()
    {
        $mock = $this->getCleanMock(Plugin::class, ['__invoke']);

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('name')
              ->willReturn('foo');

        $route->expects($this->once())
              ->method('params')
              ->willReturn([]);

        $mock->expects($this->any())
             ->method('route')
             ->willReturn($route);

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke());
    }
}
