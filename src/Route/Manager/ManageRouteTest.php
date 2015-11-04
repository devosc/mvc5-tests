<?php

namespace Mvc5\Test\Route\Manager;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Manager\ManageRoute;
use Mvc5\Route\Manager\RouteManager;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class ManageRouteTest
    extends TestCase
{
    /**
     *
     */
    public function test_definition()
    {
        $mock = $this->getCleanMockForTrait(ManageRoute::class, ['definition', 'setRouteManager']);

        $rm = $this->getCleanMock(RouteManager::class);

        $rm->expects($this->once())
           ->method('definition')
           ->willReturn('foo');

        $mock->setRouteManager($rm);

        $this->assertEquals('foo', $mock->definition([]));
    }

    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMockForTrait(ManageRoute::class, ['exception', 'setRouteManager']);

        $rm = $this->getCleanMock(RouteManager::class);

        $rm->expects($this->once())
           ->method('exception')
           ->willReturn('foo');

        $mock->setRouteManager($rm);

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->exception($route, new \Exception));
    }

    /**
     *
     */
    public function test_match()
    {
        $mock = $this->getCleanMockForTrait(ManageRoute::class, ['match', 'setRouteManager']);

        $rm = $this->getCleanMock(RouteManager::class);

        $rm->expects($this->once())
            ->method('match')
            ->willReturn('foo');

        $mock->setRouteManager($rm);

        $definition = $this->getCleanMock(Definition::class);
        $route      = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->match($definition, $route));
    }

    /**
     *
     */
    public function test_route()
    {
        $mock = $this->getCleanMockForTrait(ManageRoute::class, ['route', 'setRouteManager']);

        $rm = $this->getCleanMock(RouteManager::class);

        $rm->expects($this->once())
           ->method('route')
           ->willReturn('foo');

        $mock->setRouteManager($rm);

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->route($route));
    }

    /**
     *
     */
    public function test_setRouteManager()
    {
        $mock = $this->getCleanMockForTrait(ManageRoute::class, ['setRouteManager']);

        $rm = $this->getCleanMock(RouteManager::class);

        $this->assertEquals(null, $mock->setRouteManager($rm));
    }
}
