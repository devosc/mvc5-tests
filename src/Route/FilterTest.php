<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\Route;
use Mvc5\Route\Filter;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FilterTest
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
              ->method('set');

        $route->expects($this->any())
              ->method('get')
              ->willReturn('foo');

        (new Filter)->__invoke($route);
    }
}
