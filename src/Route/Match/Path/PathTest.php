<?php

namespace Mvc5\Test\Route\Match\Path;

use Mvc5\Route\Match\Path\Path;
use Mvc5\Route\Route;
use Mvc5\Route\Definition\Definition;
use Mvc5\Test\Test\TestCase;

class PathTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->any())
              ->method('path')
              ->willReturn('foo');

        $route->expects($this->any())
              ->method('params')
              ->willReturn([]);

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('defaults')
                   ->willReturn([]);

        $definition->expects($this->any())
                   ->method('paramMap')
                   ->willReturn([]);

        $mock = $this->getCleanMock(Path::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('params')
             ->willReturn([]);

        $this->assertEquals($route, $mock->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_invoke_not_matched()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->any())
              ->method('path')
              ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('regex')
                   ->willReturn('bar');

        $mock = $this->getCleanMock(Path::class, ['__invoke']);

        $this->assertEquals(null, $mock->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_params()
    {
        $mock = $this->getCleanMock(PathParams::class, ['params', 'testParams']);

        $this->assertEquals(['bar' => 'baz'], $mock->testParams(['foo' => 'bar'], ['foo' => 'baz']));
    }
}
