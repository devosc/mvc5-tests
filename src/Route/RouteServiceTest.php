<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\RouteService;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class RouteServiceTest
    extends TestCase
{
    /**
     *
     */
    public function test_route()
    {
        $mock = $this->getCleanMockForTrait(RouteService::class, ['route', 'setRoute']);

        $route = $this->getCleanMock(Route::class);

        $mock->setRoute($route);

        $this->assertEquals($route, $mock->route());
    }
}
