<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Route\Match\Path;
use Mvc5\Route\Route;
use Mvc5\Route\Definition;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PathTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->any())
              ->method('path')
              ->willReturn('foo');

        $route->expects($this->any())
              ->method('params')
              ->willReturn([]);

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('defaults')
                   ->willReturn([]);

        $definition->expects($this->any())
                   ->method('paramMap')
                   ->willReturn([]);

        /** @var Path|Mock $mock */

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
        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->any())
              ->method('path')
              ->willReturn('foo');

        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->any())
                   ->method('regex')
                   ->willReturn('bar');

        /** @var Path|Mock $mock */

        $mock = $this->getCleanMock(Path::class, ['__invoke']);

        $this->assertEquals(null, $mock->__invoke($route, $definition));
    }

    /**
     *
     */
    public function test_params()
    {
        /** @var PathParams|Mock $mock */

        $mock = $this->getCleanMock(PathParams::class, ['params', 'testParams']);

        $this->assertEquals(['bar' => 'baz'], $mock->testParams(['foo' => 'bar'], ['foo' => 'baz']));
    }
}
