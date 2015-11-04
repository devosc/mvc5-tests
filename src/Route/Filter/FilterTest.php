<?php

namespace Mvc5\Test\Route\Filter;

use Mvc5\Route\Route;
use Mvc5\Route\Filter\Filter;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Route::class);

        $route->expects($this->any())
              ->method('set');

        $route->expects($this->any())
              ->method('get')
              ->willReturn('foo');

        $this->assertEquals(null, (new Filter)->__invoke($route));
    }
}
