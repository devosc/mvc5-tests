<?php

namespace Mvc5\Test\Route\Manager;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Manager\Manager;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    public function test_definition()
    {
        $mock = $this->getCleanMock(Manager::class, ['definition']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->definition([]));
    }

    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Manager::class, ['exception']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->exception($route, new \Exception));
    }

    /**
     *
     */
    public function test_match()
    {
        $mock = $this->getCleanMock(Manager::class, ['match']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $definition = $this->getCleanMock(Definition::class);
        $route      = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->match($definition, $route));
    }

    /**
     *
     */
    public function test_route()
    {
        $mock = $this->getCleanMock(Manager::class, ['route']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->route($route));
   }
}
